<?php

namespace App\Http\Livewire\Vendedor;

use Livewire\Component;
use App\Models\Paises;
use App\Models\Vendedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class CreateVendedorController extends Component
{
    public $paises = array();

    public $nombre_vendedor;
    public $email_vendedor;
    public $idciudad;
    public $direccion_vendedor;
    public $telefono_vendedor;
    public $usuario;
    public $porc_animalitos;
    
    public function mount()
    {
        $this->paises = Paises::All();
    }
    public function render()
    {
        return view('livewire.vendedor.create-vendedor-controller');
    }

    public function guardarVendedor()
    {
        $vendedor = new Vendedor;        
        $vendedor->idagente             = Auth::user()->idagente;
        $vendedor->nombre_vendedor      = $this->nombre_vendedor;
        $vendedor->email_vendedor       = $this->email_vendedor;
        $vendedor->telefono_vendedor    = $this->telefono_vendedor;
        $vendedor->direccion_vendedor   = $this->direccion_vendedor;
        $vendedor->idciudad             = $this->idciudad;
        $vendedor->usuario              = $this->usuario;
        $vendedor->clave                = sha1('000000');
        $vendedor->porc_animalitos      = $this->porc_animalitos;
        $vendedor->token                = Hash::make($this->usuario);
        $vendedor->save();
        $this->emit('render');
    }
}
