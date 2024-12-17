<?php

namespace App\Task\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function rules()
    {
        return [
            "name"=>'required|string',
            "description"=>'required|string',
            "status"=>'sometimes|string|in:Pendiente,En curso,Bloqueada,Finalizada',
            "project_id"=>'required|string|exists:projects,id',
            "assigned_to"=>'required|string|exists:users,id'
        ];
    }
}