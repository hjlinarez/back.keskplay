<?php

namespace App\Http\Livewire\Vendedor;

use Livewire\Component;
use App\Models\Vendedor;
use App\Models\LoteriasVendedor;
use App\Models\Loterias;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Renderless;


class LoteriaController extends Component
{

    public $idvendedor;
    public $datos               = array();
    public $loterias            = array();


    public $idloteria;
    public $cupo;
    public $minutos;

    protected $listeners = ['render' => 'render'];


    public function mount($idvendedor)
    {
        $this->idvendedor = $idvendedor;
    }




    public function eliminarLoteria($idregistro)
    {
        LoteriasVendedor::find($idregistro)->delete();
        $this->emit('render_loterias');
        //$this->emitTo('CreateLoteria', 'cargarLoterias');  
        //$this->skipRender();
    }



    public function EditarLoteria($idregistro)
    {

        //$registro = LoteriasVendedor::find($idregistro)->get();    
        //$this->idloteria = $registro->idloteria;
        //$this->cupo = $registro->cupo;
        //$this->minutos = $registro->minutos;
        $this->skipRender();
    }



    public function render()
    {
        $this->loterias = DB::table('l_vendedor_loterias')
                            ->join('cha_banca_vendedores', 'l_vendedor_loterias.idvendedor', '=', 'cha_banca_vendedores.idvendedor')
                            ->join('l_loteria', 'l_vendedor_loterias.idloteria', '=', 'l_loteria.idloteria')
                            ->where('l_vendedor_loterias.idvendedor', '=', $this->idvendedor)
                            ->select('l_vendedor_loterias.idregistro', 'l_vendedor_loterias.idloteria', 'l_loteria.nombre_loteria', 'l_vendedor_loterias.cupo',  'l_vendedor_loterias.minutos')
                            ->get();
        $this->datos = Vendedor::Where("idvendedor", $this->idvendedor)->first();
        return view('livewire.vendedor.loteria-controller');
    }
}
