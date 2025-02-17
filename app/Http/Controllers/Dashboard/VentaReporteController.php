<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Catalogo;
use Illuminate\Http\Request;

class VentaReporteController extends Controller
{
    //
    public function index(){
        
                
        $catalogo = Catalogo::findOrFail(3);
        $array_catalogo [] = $catalogo;
        while($catalogo->inferior != null){
            $array_catalogo[] = $catalogo->inferior;
            $catalogo = $catalogo->inferior;
        }
        
        return $array_catalogo;
                
        return view('dashboard.reportes.ventas.index');


    }
}
