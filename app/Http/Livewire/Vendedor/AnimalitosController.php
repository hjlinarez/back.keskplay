<?php
namespace App\Http\Livewire\Vendedor;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Loterias;
use App\Models\AnimalitosTicket;
use App\Models\LoteriasSorteo;
use App\Models\LoteriasOpcion;
use App\Models\Vendedor;

class AnimalitosController extends Component
{
    public $loterias_clasificacion = array();
    public $monto;
    public $font_size;
    public $formato_ticket;
    public $fuentes = [6,8,10,12,14,18,20,24,32,40,48,60];
    public $formatoTicket  = ['Normal','Comprimido'];

    //public $mensaje = '';




    public $idticket_consulta;

    public $txt_consulta;

    public function mount()
    {
        $vendedor = Vendedor::where('idvendedor', '=', auth::user()->idvendedor)->first();
        $this->font_size = $vendedor->font_size;
        $this->formato_ticket = $vendedor->formato_ticket;
        $this->idticket_consulta = 16381;
    }

    public function render()
    {
        $this->loterias_clasificacion = Loterias::select('clasificacion')->groupBy('clasificacion')->get();
        return view('livewire.vendedor.animalitos-controller');
    }


    public function agregarJugada($parametros)
    {
        $parametros = json_decode($parametros);
        //$this->mensaje = 'llego';
        //$this->monto = $parametros->monto;

        $opcion = $parametros->opcion; //opcion seleccionada


        $jugadas = session()->get('jugadas');
        foreach ($parametros->idsorteos as $item) {
            $encontro = false;
            $posicion = 0;
            foreach ($jugadas as $pos => $jugada) {
                if ($jugada["loteria"] == $item->loteria and $jugada["id"] == $item->idsorteo and $jugada["opcion"] == $parametros->nameopcion) {
                    $encontro = true;
                    $posicion = $pos;
                }
            }

            if ($encontro) {
                $jugada_new = $jugadas[$posicion];
                $jugada_new["monto"] += $parametros->monto;
                $jugadas[$posicion] = $jugada_new;
            } else {
                $idopcion = 0;
                $idsorteo = $item->idsorteo;

                $loteriaSorteo = LoteriasSorteo::where("idsorteo", '=', $idsorteo)->first();
                $idloteria = $loteriaSorteo->idloteria;

                $loterias = Loterias::where('idloteria', '=', $idloteria)->first();

                $opciones = LoteriasOpcion::where('numero_opcion', '=', $opcion)->where('idloteria', '=', $idloteria)->first();
                $idopcion = $opciones->idopcion;

                $factor_pago = $loterias->factor_pago;
                $jugadas[] = [
                    "loteria" => $item->loteria,
                    "id" => $idsorteo, // aqui se guardar el id del sorteo de la tabla l_loteria_sorteos
                    "idopcion" => $idopcion, // esta es la opcion seleccionada correspondiente a la latbla l_loteria_opciones
                    "opcion" => $parametros->nameopcion, // este campo es el que se muestra en la pantalla
                    "factor_pago" => $factor_pago,
                    "monto" => $parametros->monto // monto que se apostara a la opcion seleccionada
                ];
            }
        }

        session(['jugadas' => $jugadas]);
        $this->emit('actualizarJugadas');
    }

    public function crearTicket()
    {
        $metodo_venta_animalitos = 'POST';
        $ticket = new AnimalitosTicket;
        $ticket->serial = 11;
        $ticket->idvendedor = Auth::user()->idvendedor;
        $ticket->idmoneda = 'COP';
        $ticket->ip = '127.0.0.1';
        $ticket->nombre_cliente = '';
        $ticket->metodo_venta = $metodo_venta_animalitos;
        $ticket->save();
    }


    /*public function refrescarSorteos()
    {
        $this->emit('actualizarSorteos');
        $this->emit('ActualizarBotones');
        //$this->emit('listaTicketAnular');
        //$this->emit('opciones', $this->clasificacion);
    }*/

    public function GuadarConfiguracion()
    {
        $this->skipRender();
        $vendedor = Vendedor::find(auth::user()->idvendedor);
        $vendedor->font_size = $this->font_size;
        $vendedor->formato_ticket = $this->formato_ticket;
        $vendedor->save();
        
    }

    public function consultarTicket()
    {
        $this->skipRender();
        $this->txt_consulta = $this->idticket_consulta;
    }
}
