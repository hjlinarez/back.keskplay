<?php

namespace App\Http\Controllers\Agente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agente;
use App\Models\Vendedor;
use App\Models\Operador;
use Illuminate\Support\Facades\Hash;

class AgenteController extends Controller
{
    //
 
    public function cambiarPasswordAll()
    {
        $agentes = Agente::all();
        
        foreach ($agentes as $agente)
        {
            $agente->password = Hash::make('000000');
            $agente->save();
        }

        $vendedores = Vendedor::all();        
        foreach ($vendedores as $vendedor)
        {
            $vendedor->password = Hash::make('000000');
            $vendedor->save();
        }

        $operadores = Operador::all();        
        foreach ($operadores as $operador)
        {
            $operador->password = Hash::make('000000');
            $operador->save();
        }
    }
}



