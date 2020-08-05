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
            "ivaCondition" => "required",
            "industry" => "required",
            "amountEmployees" => "required|integer"
        ];
    }

    public function messages(){

        return [
            "ivaCondition.required" => "Condición de IVA es requerida",
            "industry.required" => "Industria es requerida",
            "amountEmployees.required" => "Cantidad de empleados es requerida",
            "amountEmployees.integer" => "Cantidad de empleados debe ser un número" 
        ];

    }

}
