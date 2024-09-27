<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NewoperadorController extends Component
{
    public $operador;
    public $suboperadores = false;
    public function mount()
    {
        $this->operador["name"]             = '';
        $this->operador["email"]            = '';
        $this->operador["suboperadores"]    = 0;
        $this->suboperadores = auth::user()->suboperadores;
        
    }

    public function render()
    {
        return view('livewire.newoperador-controller');
    }

    public function registrar(){

        if (empty($this->operador["name"]))
        {
            $this->emit('mensaje', "Lo siento", "El Nombre es invalido", "error");     
            return false;
        }

        if (empty($this->operador["email"]))
        {
            $this->emit('mensaje', "Lo siento", "El Email es invalido", "error");     
            return false;
        }

        //$this->operador["name"]     = '';
        //$this->operador["email"]    = '';    

        $this->emit('RegistrarOperador', $this->operador);
        
    }
}
