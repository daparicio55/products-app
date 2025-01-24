<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClienteRequest extends FormRequest
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
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'numero_documento' => [
                'required',
                Rule::unique('clientes', 'numero_documento')->ignore($this->route('cliente'))->where(function ($query){
                    return $query->where('tipo_documento', $this->tipo_documento)
                    ->where('numero_documento', $this->numero_documento);
                }),
            ],
            'tipo_documento' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
        ];
    }
}
