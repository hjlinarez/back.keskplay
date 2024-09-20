<?php

namespace App\Http\Livewire\Vendedor;

use Livewire\Component;
use App\Models\LoteriasVendedor;
use App\Models\Loterias;
use Illuminate\Support\Facades\DB;

class CreateLoteria extends Component
{
    public $loteriasDisponibles;
    public $idvendedor;
    public $idloteria;
    public $cupo;
    public $minutos;
    protected $listeners = ['render_loterias' => 'cargarLoterias'];

    protected $rules = [
                        'cupo'=>'required|min:0',
                        'minutos'=>'required|min:0|max:30',
                        ];


    public function cargarLoterias()
    {
        
        $loterias = DB::table('l_vendedor_loterias')
            ->join('cha_banca_vendedores', 'l_vendedor_loterias.idvendedor', '=', 'cha_banca_vendedores.idvendedor')
            ->join('l_loteria', 'l_vendedor_loterias.idloteria', '=', 'l_loteria.idloteria')
            ->where('l_vendedor_loterias.idvendedor', '=', $this->idvendedor)
            ->select('l_vendedor_loterias.idregistro', 'l_vendedor_loterias.idloteria', 'l_loteria.nombre_loteria', 'l_vendedor_loterias.cupo',  'l_vendedor_loterias.minutos')
            ->get();

        $loterias_bd    = Loterias::where('activa', '=', 1)->get();
        $nueva_lot = array();
        foreach ($loterias_bd as $lot) {
            $encontrado = false;
            foreach ($loterias as $lot2) {
                if ($lot->idloteria == $lot2->idloteria) {
                    $encontrado = true;
                }
            }
            if (!$encontrado) {
                $nueva_lot[] = [
                    "idloteria" => $lot->idloteria,
                    "nombre_loteria" => $lot->nombre_loteria
                ];
            }
        }

        $this->loteriasDisponibles = $nueva_lot;
    }

    public function mount($idvendedor)
    {
        $this->idvendedor = $idvendedor;
        $this->cargarLoterias();
    }

    public function guardar()
    {
        $this->validate();
        $registro = new LoteriasVendedor;
        $registro->updateOrCreate(["idvendedor" => $this->idvendedor, "idloteria" => $this->idloteria, "cupo" => $this->cupo, "minutos" => $this->minutos]);
        $this->emit('render');
        $this->cargarLoterias();

    }

    public function render()
    {
        return view('livewire.vendedor.create-loteria');
    }
}
