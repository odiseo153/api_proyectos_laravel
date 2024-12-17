<?php

namespace App\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

abstract class BaseFormRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {

        $this->replace($this->convertKeysToSnakeCase($this->all()));
    }

    private function convertKeysToSnakeCase(array $input): array
    {
        $snakeCased = [];
        foreach ($input as $key => $value) {
            $snakeKey = Str::snake($key);
            $snakeCased[$snakeKey] = is_array($value) ? $this->convertKeysToSnakeCase($value) : $value;
        }
        return $snakeCased;
    }
}




