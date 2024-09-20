<?php
namespace App\Http\Livewire\Vendedor;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
class OpcionesanimalitosController extends Component
{
    public $opciones;
    public $clasificacion;
    protected  $listeners  = ['opciones'];

    public function mount()
    {
        $this->clasificacion = 'ANIMALES 36';
    }
    public function render()
    {
        $this->opciones = DB::table('l_loteria_opciones')
                                    ->select('l_loteria_opciones.numero_opcion','l_loteria_opciones.nombre_opcion' )
                                    ->join('l_loteria', 'l_loteria.idloteria', '=', 'l_loteria_opciones.idloteria')
                                    ->where('l_loteria.clasificacion','=',$this->clasificacion)
                                    ->groupBy('l_loteria_opciones.numero_opcion','l_loteria_opciones.nombre_opcion' )
                                    ->get();
        //$this->opciones = array("Leon","Tigre", "Leopardo");
        return view('livewire.vendedor.opcionesanimalitos-controller');
    }

    public function opciones($clasificacion)
    {
        $this->clasificacion = $clasificacion;
    }
}
