<?php

namespace App\Http\Livewire\Vendedor;

use Livewire\Component;
USE Illuminate\Support\Facades\DB;
USE App\Models\Loterias;
use Carbon\Carbon;
class ResultadosAnimalitosController extends Component
{
    public $fecha;
    public $idloteria;
    public $loterias = array();
    public $resultados;
    protected $listeners = ['IniciarResultados'=>'mount'];

   

    public function mount()
    {
        
        $this->loterias = Loterias::where('activa',1)->get();     
        $this->fecha = Carbon::now()->format('Y-m-d');
        
    }

    public function render()
    {   
        
        $this->resultados = DB::table('l_resultados')                                            
                                ->join('l_loteria_sorteos','l_loteria_sorteos.idsorteo','=', 'l_resultados.idsorteo')
                                ->join('l_loteria_opciones','l_loteria_opciones.idopcion','=', 'l_resultados.idopcion')                                
                                ->join('l_loteria', 'l_loteria.idloteria', '=', 'l_loteria_sorteos.idloteria')
                                ->where('l_loteria.idloteria', $this->idloteria)
                                ->where('l_resultados.fecha','=', $this->fecha)
                                ->select(   
                                            'l_loteria_sorteos.hora_sorteo', 
                                            'l_loteria.nombre_sistema', 
                                            'l_loteria_opciones.numero_opcion', 
                                            'l_loteria_opciones.nombre_opcion',
                                            'l_loteria_opciones.imagen_opcion'
                                        )
                                ->orderBy('l_loteria_sorteos.hora_sorteo')
                                ->get();

        return view('livewire.vendedor.resultados-animalitos-controller');
    }
}
