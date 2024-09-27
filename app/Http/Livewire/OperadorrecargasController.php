<?php

namespace App\Http\Livewire;
use App\Models\Operador;
use Livewire\Component;
use App\Models\Recargasopera;
use Illuminate\Support\Facades\DB;

class OperadorrecargasController extends Component
{
    public $operadorName;
    public $idopera;

    public $desde;
    public $hasta;  

    public $datos;  

    public function mount(Operador $operador){
        $this->operadorName = $operador->name;
        $this->idopera = $operador->id;

        $hoy = getdate();
        $dia = $hoy['mday'] < 10 ? '0'.$hoy['mday'] : $hoy['mday'];
        $mes = $hoy['mon'] < 10 ? '0'.$hoy['mon'] : $hoy['mon'];
        $ano = $hoy['year'];
        
        $this->desde    = $ano.'-'.$mes.'-'.$dia;
        $this->hasta    = $ano.'-'.$mes.'-'.$dia;


    }
    public function render()
    {
        $this->datos = Recargasopera::where('idopera', $this->idopera)
                                ->where(DB::raw('date(created_at)'), '>=', $this->desde)
                                ->where(DB::raw('date(created_at)'), '<=', $this->hasta)
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('livewire.operadorrecargas-controller');
    }


    public function historicoRecargas($id)
    {
        $this->emit('open_modal', 'modalHistoricoRecargas'.$id);        
    }
}
