<?php

namespace App\Http\Livewire\Vendedor;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BotonesAnimalitosController extends Component
{
    public $anular          = 0;
    public $pagar           = 0;    
    public $tiempo_anular   = 300;
    public $tiempo_pagar    = 600000;
    protected $listeners    = ['ActualizarBotones'];

    public function render()
    {
        $tickets = DB::table('l_ticket')
                                ->join('l_ticket_jugadas','l_ticket.idticket','=', 'l_ticket_jugadas.idticket')
                                ->select('l_ticket.idticket', 'l_ticket.fecha_hora', DB::raw('sum(l_ticket_jugadas.monto_apuesta ) as monto'))                        
                                ->where('idvendedor','=', Auth::user()->idvendedor)                        
                                ->where(DB::raw('TIME_TO_SEC(TIMEDIFF(now(),l_ticket.fecha_hora))'), '<', $this->tiempo_anular)
                                ->where('l_ticket.idestatusticket', '<>', 'ANU')
                                ->groupBy('l_ticket.idticket', 'l_ticket.fecha_hora')
                                ->orderby('l_ticket.idticket','desc')
                                ->get();
        $this->anular = count($tickets);


        $tickets_pagar = DB::table('l_ticket')
                                ->join('l_ticket_jugadas','l_ticket.idticket','=', 'l_ticket_jugadas.idticket')
                                ->select(   
                                            'l_ticket.idticket', 
                                            'l_ticket.fecha_hora', 
                                            DB::raw('sum(l_ticket_jugadas.monto_apuesta * l_ticket_jugadas.factor ) as premio'),
                                            DB::raw('(select sum(l_ticket_pagos.monto) from l_ticket_pagos where l_ticket_pagos.idticket = l_ticket.idticket) as pagado' )
                                        )                        
                                ->where('idvendedor','=', Auth::user()->idvendedor)                        
                                ->where(DB::raw('TIME_TO_SEC(TIMEDIFF(now(),l_ticket.fecha_hora))'), '<', $this->tiempo_pagar)
                                ->where('l_ticket.idestatusticket', '<>', 'ANU')
                                ->where('l_ticket_jugadas.estatus', '=', 'GAN')
                                ->groupBy('l_ticket.idticket', 'l_ticket.fecha_hora')
                                ->orderby('l_ticket.idticket','desc')
                                ->get();

        $this->pagar = 0;
        foreach($tickets_pagar as $tick)
        {
            $pendiente = $tick->premio - $tick->pagado;
            if ($pendiente > 0) $this->pagar += 1;
        }
        

        return view('livewire.vendedor.botones-animalitos-controller');
    }

    public function ActualizarBotones()
    {

    }


}
