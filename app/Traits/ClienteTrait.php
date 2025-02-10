<?php

namespace App\Traits;

use App\Models\Dashboard\Cliente;


trait ClienteTrait
{
    
    public function buscarCliente($numero,$tipo){
        $key = config('app.perudevtoken');
        //buscamos el cliente en la base de datos.
        $cliente = Cliente::where('numero_documento',$numero)
        ->where('tipo_documento_id',$tipo)
        ->first();
        //verificamos si existe el cliente o no
        if(!$cliente){
            //el cliente no se encontro en la base de datos
            //ahora lo buscamos en al api de perudevs
            $data_response = null;
            //obtenemos el tipo de documento si es DNI
            if($tipo == 1){
                return $this->getApiDni($numero,$key);
            }
            //obtenemos el tipo de documento si es RUC
            if($tipo == 2){
                return $this->getApiRuc($numero,$key);
            }
        }else{
            //si ya esta registrado en la base de datos
            $data = [
                'cliente_id' => $cliente->id,
                'nombre' => $cliente->nombre,
                'apellido_paterno' => $cliente->apellido_paterno,
                'apellido_materno' => $cliente->apellido_materno,
                'numero_documento' => $cliente->numero_documento,
                'tipo_documento_id' => $cliente->tipo_documento_id,
                'tipo_documento' => $cliente->tipoDocumento->nombre,
                'direccion' => $cliente->direccion,
                'telefono' => $cliente->telefono,
                'email' => $cliente->email
            ];
            return response()->json($data);
        }
    }
    public function getApiRuc($numero,$key){
        $url = "https://api.perudevs.com/api/v1/ruc?document=$numero&key=$key";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $data_response = json_decode($response);
        curl_close($ch);
        return $this->buildFromApiRuc($data_response);
    }

    public function buildFromApiRuc($data){
        $data = [
            'cliente_id' => 0,
            'nombre' => $data->resultado->razon_social,
            'apellido_paterno' => '-',
            'apellido_materno' => '-',
            'numero_documento' => $data->resultado->id,
            'tipo_documento' => 'RUC',
            'direccion' => $data->resultado->direccion .' '. $data->resultado->distrito.' '. $data->resultado->provincia.' '. $data->resultado->departamento,
            'telefono' => '999999999',
            'email' => 'sincorreo@gmail.com',
            'nombre_comercial' => $data->resultado->nombre_comercial,
            'departamento' => $data->resultado->departamento,
            'provincia' => $data->resultado->provincia,
            'distrito' => $data->resultado->distrito,
            'direccion' => $data->resultado->direccion
        ];
        return response()->json($data);
    }

    public function getApiDni($numero,$key){
        $url = "https://api.perudevs.com/api/v1/dni/complete?document=$numero&key=$key";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $data_response = json_decode($response);
        curl_close($ch);      
        return $this->buildFromApiDni($data_response);
    }
    
    public function buildFromApiDni($data){
        $data = [
            'cliente_id' => 0,
            'nombre' => $data->resultado->nombres,
            'apellido_paterno' => $data->resultado->apellido_paterno,
            'apellido_materno' => $data->resultado->apellido_materno,
            'numero_documento' => $data->resultado->id,
            'tipo_documento' => 'DNI',
            'direccion' => 'sin dirección',
            'telefono' => '999999999',
            'email' => 'sincorreo@gmail.com'
        ];
        return response()->json($data);
    }
}
