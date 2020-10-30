<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferStoreRequest extends FormRequest
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
            "minWage" => "required|numeric",
            "description" => "required",
            "category" => "required|exists:job_categories,id",
            "jobPosition" => "required",
            "wageType" => "required"
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "Titulo es requerido",
            "minWage.required" => "Sueldo mínimo es requerido",
            "minWage.numeric" => "Sueldo mínimo debe ser un número",
            "description.required" => "Descripción es requerida",
            "category.required" => "Categoría es requerida",
            "category.exists" => "Categoría es inválida",
            "jobPosition.required" => "Puesto de Trabajo es requerido",
            "wageType.required" => "Tipo de renta es requerido"
        ];
    }
}
