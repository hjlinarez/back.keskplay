<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Vendedor;


class vendedorController extends Controller
{
    //
    public function index()
    {
        $datos = Vendedor::all();
        return $datos;
    }
}
