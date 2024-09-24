<?php

namespace App\Http\Livewire;
use App\Models\Cajas;
use Livewire\Component;
use App\Models\Recargas;
use Illuminate\Support\Facades\DB;
class HistoricorecargasController extends Component
{
    public $cajaName;
    public $iduser;

    public $desde;
    public $hasta;  

    public $datos;  

    public function mount(Cajas $caja){
        $this->cajaName = $caja->name;
        $this->iduser = $caja->id;

        $hoy = getdate();
        $dia = $hoy['mday'] < 10 ? '0'.$hoy['mday'] : $hoy['mday'];
        $mes = $hoy['mon'] < 10 ? '0'.$hoy['mon'] : $hoy['mon'];
        $ano = $hoy['year'];
        
        $this->desde    = $ano.'-'.$mes.'-'.$dia;
        $this->hasta    = $ano.'-'.$mes.'-'.$dia;


    }
    public function render()
    {   
        $this->datos = Recargas::where('iduser', $this->iduser)
                                ->where(DB::raw('date(created_at)'), '>=', $this->desde)
                                ->where(DB::raw('date(created_at)'), '<=', $this->hasta)
                                ->orderBy('created_at', 'desc')
                                ->get();
        return view('livewire.historicorecargas-controller');
    }


    public function historicoRecargas($id)
    {
        $this->emit('open_modal', 'modalHistoricoRecargas'.$id);        
    }

}
