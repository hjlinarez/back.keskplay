<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cajas;
use Illuminate\Support\Facades\Auth;

class NuevacajaController extends Component
{
        public $name;
    public $email;
    public $login;
    public $password;
    public $repeat_password;


    public $apuesta_minima;
    public $apuesta_maxima;

    //VARIABLES MINI JACKPOT
    public $acumulado_mini_jackpot;
    public $porc_mini_jackpot;
    public $limite_mini_jackpot;
    public $porc_entrega_mini_jackpot;


    //VARIABLES SUPER JACKPOT
    public $acumulado_super_jackpot;
    public $porc_super_jackpot;
    public $limite_super_jackpot;
    public $porc_entrega_super_jackpot;


    //VARIABLES MEGA JACKPOT
    public $acumulado_mega_jackpot;
    public $porc_mega_jackpot;
    public $limite_mega_jackpot;
    public $porc_entrega_mega_jackpot;


    public $mensaje;


    public function limpiar()
    {
        $this->name = null;
        $this->email = null;
        $this->login = null;
        $this->password = null;
        $this->repeat_password = null;

        $this->apuesta_minima = null;
        $this->apuesta_maxima = null;

        $this->acumulado_mini_jackpot       = 0;
        $this->porc_mini_jackpot            = 0;
        $this->limite_mini_jackpot          = 0;
        $this->porc_entrega_mini_jackpot    = 0;
        $this->acumulado_super_jackpot      = 0;
        $this->porc_super_jackpot           = 0;
        $this->limite_super_jackpot         = 0;
        $this->porc_entrega_super_jackpot   = 0;
        $this->acumulado_mega_jackpot       = 0;
        $this->porc_mega_jackpot            = 0;
        $this->limite_mega_jackpot          = 0;
        $this->porc_entrega_mega_jackpot    = 0;
    }

    public function mount()
    {
        
        $this->limpiar();
        

    }

    public function render()
    {
        return view('livewire.nuevacaja-controller');
    }



    public function CrearCaja()
    {
        if ($this->name == null){ $this->emit('mensaje', "Disculpe", "Debe indicar el nombre de la caja", "error"); return false;} 
        if ($this->email == null){ $this->emit('mensaje', "Disculpe", "Indique el correo electronico", "error"); return false;} 
        if ($this->login == null){ $this->emit('mensaje', "Disculpe", "Indique el login de la caja", "error"); return false;} 
        if ($this->password == null){ $this->emit('mensaje', "Disculpe", "Indique el password", "error"); return false;} 
        if ($this->password <> $this->repeat_password){ $this->emit('mensaje', "Disculpe", "Las claves no coincide.", "error"); return false;} 

        $caja = new Cajas;
        $caja->idopera  = auth::user()->id;
        $caja->name     = $this->name;
        $caja->email    = $this->email;
        $caja->login    = $this->login;
        $caja->password = $this->password;
        $caja->pagos    = '{"monedas":[ ]}';

        if ($caja->save())
        {
            $this->emit('mensaje', "Exito", "La caja se ha creado satisfactoriamente", "success"); 
            $this->limpiar();
            return ;
        }
    }
}

