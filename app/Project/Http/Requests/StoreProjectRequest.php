<?php

namespace App\Project\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{


    public function rules()
    {
        return [
            "name"=> "required|string",
            "description"=> "required|string",
            "status"=>"sometimes|string|in:Activo, En progreso, Completado, Archivado",
            "leader_id"=> "required|string|exists:users,id",
        ];
    }
}






