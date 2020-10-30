<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class businessBusinessUpdateRequest extends FormRequest
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
            "businessType" => "required",
            "industry" => "required",
            "amountEmployees" => "required|integer",
            "address" => "required"
        ];
    }

    public function messages(){

        return [
            "businessType.required" => "Tipo de empresa es requerido",
            "industry.required" => "Industria es requerida",
            "amountEmployees.required" => "Cantidad de empleados es requerida",
            "amountEmployees.integer" => "Cantidad de empleados debe ser un número",
            "address.required" => "Dirección es requerida"
        ];

    }

}
