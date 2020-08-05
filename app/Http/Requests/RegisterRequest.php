<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            "name" => "required",
            "email" => "required|email|unique:users",
            "lastname" => "required",
            "desiredJob" => "required_if:role_id,==,2",
            "region" => "required|exists:regions,id",
            "commune" => "required|exists:communes,id",
            "password" => "required|confirmed",
            "businessName" => "required_if:role_id,==,3",
            "businessRut" => "required_if:role_id,==,3",
            "businessPhone" => "required_if:role_id,==,3"
        ]; 
    }

    public function messages(){

        return [
            "name.required" => "Nombre es requerido",
            "email.required" => "Email es requerido",
            "email.email" => "Email ingresado no es válido",
            "email.unique" => "Este email se encuentra registrado",
            "lastname.required" => "Apellido es requerido",
            "desiredJob.required_if" => "Puesto deseado es requerido",
            "BusinessName.required_if" => "Empresa es requerida",
            "BusinessRut.required_if" => "Rut de empresa es requerido",
            "BusinessPhone.required_if" => "Teléfono de empresa es requerido",
            "region.required" => "Región es requerida",
            "region.exists" => "Región ingresada no es válida",
            "commune.required" => "Comuna es requerida",
            "commune.exists" => "Comuna ingresada no es válida",
            "password.required" => "Constraseña es requerida",
            "password.confirmed" => "Constraseñas no coinciden"
        ];

    }
}
