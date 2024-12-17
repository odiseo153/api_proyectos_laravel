<?php

use App\Http\Middleware\LoadRoleMiddleware;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: [
            __DIR__ . '/../routes/users.php',
            __DIR__ . '/../routes/auth.php',
            __DIR__ . '/../routes/tasks.php',
            __DIR__ . '/../routes/projects.php',
        ],
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role'=>LoadRoleMiddleware::class
        ]);

        
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (UniqueConstraintViolationException $e, Request $request) {
            $errorString = $e->getMessage();
            $duplicateKeyMessage = "Duplicate key";

            if (preg_match('/Key \((.*?)\)=/', $errorString, $matches)) {
                $keyName = $matches[1];
                $duplicateKeyMessage = "Duplicate key: $keyName";
            }

            return response()->json([
                'errors' => [
                    [
                        'status' => 409,
                        'message' => $duplicateKeyMessage,
                        'source' => $request->path()
                    ]
                ]
            ], 409);
        });
        $exceptions->render(function (ValidationException $e, Request $request) {
            foreach ($e->errors() as $key => $value) {
                foreach ($value as $message) {
                    $errors[] = [
                        'status' => 422,
                        'message' => $message,
                        'source' => $key
                    ];
                }
            }

            return response()->json([
                'errors' => $errors
            ], 422);
        });


        $exceptions->render(function (AuthorizationException $e, Request $request) {
            return response()->json([
                'errors' => [
                    [
                        'status' => 403,
                        'message' => 'Unauthorized',
                        'source' => $request->path()
                    ]
                ]
            ], 403);
        });

        $exceptions->render(function (MethodNotAllowedHttpException $e, Request $request) {
            return response()->json([
                'errors' => [
                    [
                        'status' => 405,
                        'message' => 'Method not allowed',
                        'source' => $request->path()
                    ]
                ]
            ], 405);
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            return response()->json([
                'errors' => [
                    [
                        'status' => 404,
                        'message' => 'Resource not found',
                        'source' => $request->path()
                    ]
                ]
            ], 404);
        });

        $exceptions->render(function (ModelNotFoundException $e, Request $request) {
            return response()->json([
                'errors' => [
                    [
                        'status' => 404,
                        'message' => 'Model not found',
                        'source' => $request->path()
                    ]
                ]
            ], 404);
        });

        $exceptions->render(function (BadMethodCallException $e, Request $request) {
            return response()->json([
                'errors' => [
                    [
                        'status' => 405,
                        'message' => $e->getMessage(),
                        'source' => $request->path()
                    ]
                ]
            ], 405);
        });

        $exceptions->render(function (QueryException $e, Request $request) {
            return response()->json([
                'errors' => [
                    [
                        'status' => 500,
                        'message' => 'Internal server error',
                        'source' => $request->path()
                    ]
                ]
            ], 500);
        });

        $exceptions->render(function (HttpException $e, Request $request) {
            return response()->json([
                'errors' => [
                    [
                        'status' => $e->getStatusCode(),
                        'message' => $e->getMessage(),
                        'source' => $request->path()
                    ]
                ]
            ], $e->getStatusCode());
        });
    })->create();
