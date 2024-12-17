<?php

namespace App\Task\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{

    public function rules()
    {
        return [
            "name"=>'sometimes|string',
            "description"=>'sometimes|string',
            "status"=>'sometimes|string|in:Pendiente,En curso,Bloqueada,Finalizada',
            "project_id"=>'sometimes|string|exists:projects,id',
            "assigned_to"=>'sometimes|string|exists:users,id'
        ];
    }
}