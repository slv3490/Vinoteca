<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class WineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $imageRules = "sometimes|image|mimes:jpg,png,jpeg|max:2048";
        if($this->isMethod("post")) {
            $imageRules = "required|image|mimes:jpg,png,jpeg|max:2048";
        }

        return [
            "name" => ["required", "string", "max:255", Rule::unique("wines", "name")->ignore($this->route("wine"))],
            "description" => ["required", "string", "max:255"],
            "category_id" => ["required", "exists:categories,id"],
            "year" => ["required", "integer", "min:". now()->subYear(100)->year, "max:" . now()->year],
            "price" => ["required", "numeric", "min:0"],
            "stock" => ["required", "integer", "min:0"],
            "image" => $imageRules
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "El nombre es obligatorio.",
            "name.string" => "El nombre debe ser de tipo string.",
            "name.max" => "El nombre debe tener un maximo de :max caracteres.",
            "name.unique" => "El vino ya existe.",
            "description.required" => "La descripción es obligatori.a",
            "description.string" => "La descripción debe ser de tipo string.",
            "description.max" => "La descripción debe tener un maximo de :max caracteres.",
            "category_id.required" => "La categoria es obligatoria.",
            "category_id.exists" => "La categoria seleccionada no existe.",
            "year.required" => "El año es obligatorio.",
            "year.integer" => "El año debe ser de tipo entero.",
            "year.min" => "El año debe ser como minimo de :min",
            "year.max" => "El año debe ser como máximo de :max",
            "price.required" => "El precio es obligatorio.",
            "price.numeric" => "El precio debe ser de tipo numerico.",
            "price.min" => "El precio no puede ser inferior a 0",
            "stock.required" => "El stock es obligatorio.",
            "stock.integer" => "El stock debe ser de tipo entero.",
            "stock.min" => "El stock no puede ser inferior a 0",
            "image.required" => "La imagen es obligatoria.",
            "image.image" => "El archivo debe ser de tipo imagen.",
            "image.mimes" => "El formato de la imagen debe ser de tipo: jpg, jpeg o png.",
            "image.max" => "El archivo no debe pesar mas de 2mb."
        ];
    }
}
