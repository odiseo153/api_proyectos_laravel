<?php

namespace App\Project\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function rules()
    {
        return [
            "name"=> "sometimes|string",
            "description"=> "sometimes|string",
            "status"=>"sometimes|string|in:Activo, En progreso, Completado, Archivado",
            "leader_id"=> "sometimes|string|exists:users,id",
        ];
    }
}






