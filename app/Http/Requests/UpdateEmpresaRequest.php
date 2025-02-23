<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpresaRequest extends FormRequest
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
        $id = $this->route('empresa');
        return [
            'company_email' => 'required|email|unique:empresas,company_email,'.$id.',id',
            'company_password' => 'confirmed',
            'company_ruc' => 'required|min:11|max:11|unique:empresas,company_ruc,'.$id.',id',
            'company_razon_social' => 'required',
            'company_nombre_comercial' => 'required',
            'company_departamento'=> 'required',
            'company_provincia'=> 'required',
            'company_distrito'=> 'required',
            'company_urbanizacion'=> 'required',
            'company_direccion'=> 'required',
            'company_ubigeo'=> 'required'
        ];
    }
}
