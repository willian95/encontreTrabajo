<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanStoreRequest extends FormRequest
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
            "title" => "required",
            "postAmount" => "required|integer|min:1",
            "conferenceAmount" => "integer",
            "price" => "integer|min:1"
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "Titulo es requerido",
            "postAmount.required" => "Cantidad de publicaciones es requerida",
            "postAmount.integer" => "Cantidad de publicaciones debe ser un número",
            "postAmount.min" => "El mínimo de publicaciones es 1",
            "conferenceAmount.integer" => "Cantidad de video-conferenias debe ser un número",
            "price.required" => "Precio es requerido",
            "price.integer" => "Precio debe ser un número",
            "price.min" => "Precio mínimo es 1",
        ];
    }


}
