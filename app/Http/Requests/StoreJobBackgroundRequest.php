<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobBackgroundRequest extends FormRequest
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
            "company" => "required",
            "jobBg" => "required",
            "startDateBg" => "required|date",
            "endDateBg" => "nullable|date"
        ];
    }

    public function messages(){

        return[
            "company.required" => "Empresa es requerida",
            "jobBg.required" => "Puesto es requerido",
            "startDateBg.required" => "Fecha de inicio es requerido",
            "startDateBg.date" => "Fecha de inicio ingresada no es válida",
            "endDateBg.date" => "Fecha de culminación ingresada no es válida"
        ];

    }
}
