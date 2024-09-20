<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendedor;
use App\Models\Paises;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendedorController extends Controller
{
    //
    public function index()
    {
        $idagente = Auth()->User()->idagente;
        $datos = Vendedor::where("idagente",$idagente)->get();
        return view('Vendedores',["datos"=>$datos ]);
    }

   

    public function store(Request $request)
    {
        $vendedor = new Vendedor;

        $vendedor->idagente             = Auth::user()->idagente;
        $vendedor->nombre_vendedor      = $request->nombre_vendedor;
        $vendedor->email_vendedor       = $request->email_vendedor;
        $vendedor->telefono_vendedor    = $request->telefono_vendedor;
        $vendedor->direccion_vendedor   = $request->direccion_vendedor;
        $vendedor->idciudad             = $request->idciudad;
        
        $vendedor->usuario              = $request->usuario;
        $vendedor->clave                = sha1('000000');
        $vendedor->porc_animalitos      = $request->porc_animalitos;
        $vendedor->token                = Hash::make($request->usuario);
        $vendedor->save();

    }

    public function info($id)
    {
        $vendedor = Vendedor::find($id);
        return view('vendedor',["vendedor"=>$vendedor]);
    }

    public function BloquearDesbloquearVendedor($idvendedor)
    {
        $vendedor = Vendedor::find($idvendedor)->get();
        if ($vendedor->estatus == 'ACT')
        {
            $vendedor->estatus = 'BLO';
            $vendedor->save();
            return response()->json(["cod"=>201, "message"=>"El vendedor ha sido bloqueado satisfactoriamente"], 200);
        }
        else 
        {
            $vendedor->estatus = 'ACT';
            $vendedor->save();
            return response()->json(["cod"=>201, "message"=>"El vendedor ha sido activado satisfactoriamente"], 200);
        }
        
    }

}
