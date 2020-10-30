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
            "planLength" => "required",
            "offerPosting" => "required",
            "simplePostAmounts" => "nullable",
            "hightlightPostAmount" => "integer|nullable",
            "conferenceAmounts" =>  "integer|nullable",
            "downloadCurriculum" => "required",
            "showVideo" => "required",
            "downloadProfile"=> "integer|nullable",
            "position" => "required",
            "price"=> "required|min:1|integer"
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "Titulo es requerido",
            "planLength.required" => "Duración del plan es requerida",
            "offerPosting.required" => "Publicación de ofertas es requerido",
            "simplePostAmounts.integer" => "Cantidad de publicaciones simples debe ser un número",
            "hightlightPostAmount.integer" => "Cantidad de publicaciones destacadas debe ser un número",
            "conferenceAmounts.integer" => "Cantidad de entrevistas debe ser un número",
            "downloadCurriculum.required" => "La descarga de curriculum es requerida",
            "showVideo.required" => "Video del candidato es requerido",
            "downloadProfile.integer" => "Cantidad de descargas del motor de búsqueda debe ser un número",
            "position.required" => "La posición del plan es requerida",
            "price.required" => "Precio es requerido",
            "price.integer" => "Precio debe ser un número",
            "price.min" => "Precio mínimo es 1",
        ];
    }


}
