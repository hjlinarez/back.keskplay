<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cajas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class NuevacajaController extends Component
{
    public $name;
    public $email;
    public $login;
    public $password;
    public $repeat_password;


    public $apuesta_minima;
    public $apuesta_maxima;
    public $pagos;

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


        $cantidad_opciones = count(explode(",",$this->pagos));
        if ($cantidad_opciones <= 1) { $this->emit('mensaje', "Disculpe", "Campo 'Opciones de Pago' es invalido ".$cantidad_opciones, "error"); return false;} 

        if ($this->apuesta_minima <= 0)
        {
            $this->emit('mensaje', "Disculpe", "Apuesta minima es invalida", "error"); 
            return false;
        }

        if ($this->apuesta_maxima <= 0)
        {
            $this->emit('mensaje', "Disculpe", "Apuesta Maxima es invalida", "error"); 
            return false;
        }

        if ($this->apuesta_maxima <= $this->apuesta_minima)
        {
            $this->emit('mensaje', "Disculpe", "Apuesta maxima deber ser mayor que la apuesta minima", "error"); 
            return false;
        }

        //validacion del MINI jakcpo
        if ($this->acumulado_mini_jackpot < 0)
        {
            $this->emit('mensaje', "Disculpe", "El monto inicial del mini jackpot es invalido", "error"); 
            return false;
        }

        if ($this->porc_mini_jackpot < 0 or $this->porc_mini_jackpot >= 5)
        {
            $this->emit('mensaje', "Disculpe", "El porcentaje de recoleccion del mini jackpot maximo debe ser el 5%", "error"); 
            return false;
        }

        if ($this->limite_mini_jackpot < 0)
        {
            $this->emit('mensaje', "Disculpe", "El monto limite de entrega del mini jackpot es invalido", "error"); 
            return false;
        }

        if ($this->porc_entrega_mini_jackpot < 0 or $this->porc_entrega_mini_jackpot >= 100)
        {
            $this->emit('mensaje', "Disculpe", "El porcentaje de entrega del mini jackpot es invalido", "error"); 
            return false;
        }

        //validacion del SUPER jakcpo
        if ($this->acumulado_super_jackpot < 0)
        {
            $this->emit('mensaje', "Disculpe", "El monto inicial del super jackpot es invalido", "error"); 
            return false;
        }

        if ($this->porc_super_jackpot < 0 or $this->porc_super_jackpot >= 5)
        {
            $this->emit('mensaje', "Disculpe", "El porcentaje de recoleccion de super jackpot maximo debe ser el 5%", "error"); 
            return false;
        }

        if ($this->limite_super_jackpot < 0)
        {
            $this->emit('mensaje', "Disculpe", "El monto limite de entrega super jackpot es invalido", "error"); 
            return false;
        }

        if ($this->porc_entrega_super_jackpot < 0 or $this->porc_entrega_super_jackpot >= 100)
        {
            $this->emit('mensaje', "Disculpe", "El porcentaje de entrega del super jackpot es invalido", "error"); 
            return false;
        }

        //validacion del MEGA jakcpo
        if ($this->acumulado_mega_jackpot < 0)
        {
            $this->emit('mensaje', "Disculpe", "El monto inicial del mega jackpot es invalido", "error"); 
            return false;
        }

        if ($this->porc_mega_jackpot < 0 or $this->porc_mega_jackpot >= 5)
        {
            $this->emit('mensaje', "Disculpe", "El porcentaje de recoleccion del mega jackpot maximo debe ser el 5%", "error"); 
            return false;
        }

        if ($this->limite_mega_jackpot < 0)
        {
            $this->emit('mensaje', "Disculpe", "El monto limite de entrega del super jackpot es invalido", "error"); 
            return false;
        }

        if ($this->porc_entrega_mega_jackpot < 0 or $this->porc_entrega_mega_jackpot >= 100)
        {
            $this->emit('mensaje', "Disculpe", "El porcentaje de entrega de mega jackpot es invalido", "error"); 
            return false;
        }





        $caja = new Cajas;
        $caja->idopera                      = auth::user()->id;
        $caja->name                         = $this->name;
        $caja->email                        = $this->email;
        $caja->login                        = $this->login;
        $caja->password                     = Hash::make($this->password);
        $caja->pagos                        = $this->pagos;
        $caja->apuesta_minima               = $this->apuesta_minima;
        $caja->apuesta_maxima               = $this->apuesta_maxima;

        $caja->acumulado_mini_jackpot       = $this->acumulado_mini_jackpot;
        $caja->porc_mini_jackpot            = $this->porc_mini_jackpot;
        $caja->limite_mini_jackpot          = $this->limite_mini_jackpot;
        $caja->porc_entrega_mini_jackpot    = $this->porc_entrega_mini_jackpot;

        $caja->acumulado_super_jackpot       = $this->acumulado_super_jackpot;
        $caja->porc_super_jackpot            = $this->porc_super_jackpot;
        $caja->limite_super_jackpot          = $this->limite_super_jackpot;
        $caja->porc_entrega_super_jackpot    = $this->porc_entrega_super_jackpot;

        $caja->acumulado_mega_jackpot       = $this->acumulado_mega_jackpot;
        $caja->porc_mega_jackpot            = $this->porc_mega_jackpot;
        $caja->limite_mega_jackpot          = $this->limite_mega_jackpot;
        $caja->porc_entrega_mega_jackpot    = $this->porc_entrega_mega_jackpot;





        //$caja->pagos    = '{"monedas":[ ]}';

        if ($caja->save())
        {
            $this->emit('mensaje', "Exito", "La caja se ha creado satisfactoriamente", "success"); 
            $this->limpiar();
            return ;
        }
    }
}

