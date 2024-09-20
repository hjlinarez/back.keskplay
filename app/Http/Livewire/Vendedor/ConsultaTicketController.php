<?php

namespace App\Http\Livewire\Vendedor;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\AnimalitosTicket;
use Illuminate\Support\Facades\Auth;
use App\Models\TicketPagos;


class ConsultaTicketController extends Component
{
    public $idticket;
    public $ticket;
    public $jugadas;
    public $monto_total = 0;
    public $premio = 0;
    public $premio_pagado = 0;
    public $pendiente = 0 ;
    


    public function render()
    {
        
        $pagos = TicketPagos::where('idticket', $this->idticket)
                            ->select(DB::raw('sum(monto) as monto_pagado'))
                            ->first();
        if ($pagos) $this->premio_pagado = $pagos->monto_pagado;

        $jugadas = DB::table('l_ticket_jugadas')
                            ->join('l_loteria_sorteos','l_ticket_jugadas.idsorteo', '=', 'l_loteria_sorteos.idsorteo')
                            ->join('l_loteria_opciones','l_ticket_jugadas.idopcion', '=', 'l_loteria_opciones.idopcion')
                            ->join('l_loteria','l_loteria_sorteos.idloteria','=','l_loteria.idloteria')
                            ->select('l_loteria.nombre_loteria','l_loteria_sorteos.hora_sorteo','l_loteria_opciones.numero_opcion',   'l_loteria_opciones.nombre_opcion', 'l_ticket_jugadas.monto_apuesta', 'l_ticket_jugadas.estatus', 'l_ticket_jugadas.factor')
                            ->where('l_ticket_jugadas.idticket','=',$this->idticket)
                            ->get()
                            ->toArray();
        //$jugadas = AnimalitosTicketJugadas::where('idticket','=',$idticket)->get();
        $this->monto_total= 0;
        foreach($jugadas as $jugada)
        {
            $this->monto_total += $jugada->monto_apuesta;
            if ($jugada->estatus == 'GAN') $this->premio += $jugada->monto_apuesta * $jugada->factor;
        }
        
        $this->ticket = AnimalitosTicket::where('idticket','=',$this->idticket)
                                        ->where('l_ticket.idvendedor','=', auth::user()->idvendedor)
                                        ->first();
        
        $this->pendiente = $this->premio - $this->premio_pagado;
        $this->jugadas = $jugadas;

        return view('livewire.vendedor.consulta-ticket-controller');
    }

    public function consultaTicket()
    {
        //$this->idticket = $idticket;
        
        $this->ticket= 0;
        $this->jugadas= 0;
        $this->monto_total= 0;
        $this->premio= 0;
        $this->premio_pagado= 0;
    }
}
