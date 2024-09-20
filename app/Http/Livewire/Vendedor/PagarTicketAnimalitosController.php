<?php

namespace App\Http\Livewire\Vendedor;

use Livewire\Component;

USE Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PagarTicketAnimalitosController extends Component
{
    public $tickets;
    public $actualizar;
    public $listeners = ['ActualizarlistaTicketPagar'];
    public $tiempo = 600000;

    public function render()
    {
    
        $this->actualizar = false;
        $this->tickets = DB::table('l_ticket')
                                ->join('l_ticket_jugadas','l_ticket.idticket','=', 'l_ticket_jugadas.idticket')
                                ->select(   
                                            'l_ticket.idticket', 
                                            'l_ticket.fecha_hora', 
                                            DB::raw('sum(l_ticket_jugadas.monto_apuesta * l_ticket_jugadas.factor ) as premio'),
                                            DB::raw('(select sum(l_ticket_pagos.monto) from l_ticket_pagos where l_ticket_pagos.idticket = l_ticket.idticket) as pagado' )
                                        )                        
                                ->where('idvendedor','=', Auth::user()->idvendedor)                        
                                ->where(DB::raw('TIME_TO_SEC(TIMEDIFF(now(),l_ticket.fecha_hora))'), '<', $this->tiempo)
                                ->where('l_ticket.idestatusticket', '<>', 'ANU')
                                ->where('l_ticket_jugadas.estatus', '=', 'GAN')
                                ->groupBy('l_ticket.idticket', 'l_ticket.fecha_hora')
                                ->orderby('l_ticket.idticket','desc')
                                ->get();

        return view('livewire.vendedor.pagar-ticket-animalitos-controller');
    }



    public function pagarTicket($idticket)
    {
        
        $tiempo = 600;
        $affected = DB::table('l_ticket')
                            ->where('idticket', $idticket)
                            ->where('idvendedor',Auth::user()->idvendedor)
                            ->where(DB::raw('TIME_TO_SEC(TIMEDIFF(now(),fecha_hora))'), '<', $tiempo)
                            ->update(['idestatusticket'=>'ANU', 'fecha_hora_anula'=>Carbon::now()]);
        if ($affected)
        {
            $this->actualizar = true;
        }
    }

    public function ActualizarlistaTicketPagar()
    {
        $this->actualizar = true;
    }

}
