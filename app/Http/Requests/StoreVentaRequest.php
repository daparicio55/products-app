<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVentaRequest extends FormRequest
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
            'cliente_id' => 'required',
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'tipo_documento' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'metodo_pago_id' => 'required',
            'tipo_comprobante_id' => 'required',
            'fecha' => 'required',
            'cantidades'=>'required|array',
            'cantidades.*'=>'required|numeric',
            'catalogos'=>'required|array',
            'catalogos.*'=>'required|numeric',
            'precios'=>'required|array',
            'precios.*'=>'required|numeric'
        ];
    }
}
