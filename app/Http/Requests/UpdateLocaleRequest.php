<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocaleRequest extends FormRequest
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
        return [
            'codigo'=>'required|unique:locales,codigo,'.$this->route('local').',id',
            'nombre'=>'required',
            'direccion'=>'required',
            'serie'=>'required|numeric',
            'telefono'=>'required',
            'empresa_id'=>'required|exists:empresas,id'
        ];
    }
}
