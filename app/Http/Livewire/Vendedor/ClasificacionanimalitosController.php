<?php

namespace App\Http\Livewire\Vendedor;
use App\Models\Loterias;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ClasificacionanimalitosController extends Component
{
    public $loterias;
    public $loterias_clasificacion;
    public $clasificacion = '';
    public $sorteos;    
    protected $listeners = ['actualizarSorteos'];

    public function mount()
    {        
        $this->clasificacion = 'ANIMALES 36';
        $this->emit('opciones', $this->clasificacion);
    }

    public function render()
    {
        $this->sorteos = DB::table('l_loteria_sorteos')
                        ->join('l_loteria', 'l_loteria.idloteria','=','l_loteria_sorteos.idloteria')
                        ->select('l_loteria.nombre_loteria','l_loteria_sorteos.idsorteo', 'l_loteria_sorteos.hora_sorteo')
                        ->where('l_loteria.clasificacion','=',$this->clasificacion)
                        ->where('l_loteria_sorteos.hora_sorteo', '>', DB::raw('time(now())'))
                        ->orderBy('l_loteria.nombre_loteria', 'ASC')
                        ->orderBy('l_loteria_sorteos.hora_sorteo', 'ASC')
                        ->get();
        //$this->loterias = Loterias::All();
        $this->loterias_clasificacion = Loterias::select('clasificacion')->groupBy('clasificacion')->get();        
        $this->emit('opciones', $this->clasificacion);
        return view('livewire.vendedor.clasificacionanimalitos-controller');
    }

    public function actualizarSorteos()
    {                
        $this->clasificacion = $this->clasificacion;
        $this->emit('opciones', $this->clasificacion);
    }

}
