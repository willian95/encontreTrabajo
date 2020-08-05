<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobResumeStoreRequest extends FormRequest
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
            "jobDescription" => "required",
            "expYears" => "required|integer",
            "availability" => "required",
            "salary" => "required|numeric",
            "desiredJob" => "required",
            "desiredArea" => "required|integer|exists:job_categories,id"
        ];
    }

    public function messages(){

        return [
            "jobDescription.required" => "Resumen laboral es requerido",
            "expYears.required" => "Años de experiencia es requerido",
            "expYears.integer" => "Años de experiencia debe ser un número",
            "availability.required" => "Disponibilidad es requerida",
            "salary.required" => "Pretensiones de renta es requerido",
            "salary.numeric" => "Pretensiones de renta debe ser un número",
            "desiredJob.required" => "Cargo deseado es requerido",
            "desiredArea.required" => "Area de preferencia es requerida",
            "desiredArea.integer" => "Area de preferencia deve ser un número",
            "desiredArea.exists" => "Area de preferencia elegida no es válida"
        ];

    }
}
