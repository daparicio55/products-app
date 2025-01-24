<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCompraRequest extends FormRequest
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
            'numero' => [
                'required',
                Rule::unique('compras')->where(function ($query) {
                    return $query->where('numero', $this->numero)
                        ->where('proveedore_id', $this->proveedore_id);
                }),
            ],
            'fecha' => 'required|date',
            'proveedore_id' => 'required|exists:proveedores,id',
            'cantidades'=>'required|array',
            'catalogos'=>'required|array',
            'precios'=>'required|array',
        ];
    }
}
