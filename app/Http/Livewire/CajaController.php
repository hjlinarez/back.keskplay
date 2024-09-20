<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cajas;

class CajaController extends Component
{   
    
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
}
