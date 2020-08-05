<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "birthDate" => "nullable|date",
            "commune" => "required|exists:communes,id",
            "region" => "required|exists:regions,id",
            "name" => "required",
            "lastname" => "required"
        ];
    }
}
