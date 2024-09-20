<?php
namespace App\Http\Livewire\Vendedor;
use Livewire\Component;
USE Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnularTicketAnimalitosController extends Component
{
    public $tickets;
    public $actualizar;
    protected $listeners = ['listaTicketAnular'];
    public $tiempo = 300;
    
    public function render()
    {        
        $this->actualizar = false;
        $this->tickets = DB::table('l_ticket')
                                ->join('l_ticket_jugadas','l_ticket.idticket','=', 'l_ticket_jugadas.idticket')
                                ->select('l_ticket.idticket', 'l_ticket.fecha_hora', DB::raw('sum(l_ticket_jugadas.monto_apuesta ) as monto'))                        
                                ->where('idvendedor','=', Auth::user()->idvendedor)                        
                                ->where(DB::raw('TIME_TO_SEC(TIMEDIFF(now(),l_ticket.fecha_hora))'), '<', $this->tiempo)
                                ->where('l_ticket.idestatusticket', '<>', 'ANU')
                                ->groupBy('l_ticket.idticket', 'l_ticket.fecha_hora')
                                ->orderby('l_ticket.idticket','desc')
                                ->get();
        return view('livewire.vendedor.anular-ticket-animalitos-controller');
    }

    public function anularTicket($idticket)
    {                
        $affected = DB::table('l_ticket')
                            ->where('idticket', $idticket)
                            ->where('idvendedor',Auth::user()->idvendedor)
                            ->where(DB::raw('TIME_TO_SEC(TIMEDIFF(now(),fecha_hora))'), '<', $this->tiempo)
                            ->update(['idestatusticket'=>'ANU', 'fecha_hora_anula'=>Carbon::now()]);
        if ($affected)
        {
            $this->actualizar = true;
            $this->emit('ActualizarBotones');
        }
    }

    public function listaTicketAnular()
    {
        $this->actualizar = true;
    }
}