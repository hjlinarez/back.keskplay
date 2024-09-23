<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cajas;

class CajaController extends Component
{   
    public $caja;
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



    public $data;
    public $filtro;
    public $estatus;
    public function mount()
    {
        $this->filtro = '';
        $this->estatus = 'ALL';
        

    }

    public function render()
    {
        if ($this->estatus == 'ALL')
        {
            $this->data = Cajas::where('name', 'like', '%'.$this->filtro.'%')->get();
        }
        else 
        {
            $this->data = Cajas::where('name', 'like', '%'.$this->filtro.'%')
                                ->where('estatus', '=', $this->estatus)
                                ->get();
        }
        
        return view('livewire.caja-controller');
    }


    public function editcaja(Cajas $caja)
    {
        $this->caja = $caja;
        $this->emit('EditCaja'); 
    }
}
