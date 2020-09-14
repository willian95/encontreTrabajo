<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarouselAdminStoreRequest extends FormRequest
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
            "image" => "required",
            "status" => "required|boolean"
        ];
    }

    public function messages()
    {
        return [
            "image.required" => "Imagen es requerida",
            "status.required" => "Estatus es requerido",
            "status.boolean" => "Estatus debe ser activado o desactivado"
        ];
    }
}
