<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobReferenceStoreRequest extends FormRequest
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
            "business_name" => "required",
            "person_name" => "required",
            "person_job_position" => "required",
            "person_telephone" => "required",
            "person_mail" => "required",
        ];
    }

    public function messages()
    {
        return [
            "business_name.required" => "Nombre de la empresa es requerido",
            "person_name.required" => "Nombre de la persona quien dará la referencia es requerido",
            "person_job_position.required" => "Cargo de la persona quien dará la referencia laboral es requerido",
            "person_telephone.required" => "Teléfono de referencia es requerido",
            "person_mail.required" => "Correo electrónico es requerido",
        ];
    }
}
