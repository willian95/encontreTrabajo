<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAcademicBackgroundRequest extends FormRequest
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
            "college" => "required",
            "educationalLevel" => "required",
            "startDate" => "required|date",
            "endDate" => "nullable|date",
            "state" => "required"
        ];
    }

    public function messages(){

        return[
            "college.required" => "Colegio es requerido",
            "educationalLevel.required" => "Nivel educacional es requerido",
            "startDate.required" => "Fecha de inicio es requerida",
            "startDate.date" => "Fecha de inicio no es válida",
            "endDate.date" => "Fecha de culminación no es válida",
            "state.required" => "Estado es requerido"
        ];

    }
}
