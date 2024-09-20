<?php

namespace App\Http\Livewire\Vendedor;

use Livewire\Component;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TicketPagos;

class PagoTicketAnimalitosController extends Component
{
 
    public $idticket;
    public $premio;
    public $pagado;
    public $pendiente;
    public $serial;
    public $input_serial;
    public $monto_pagar;
    public $messaje_monto_pagar = 'El monto supera lo pendiente...';
    public $messaje_serial = 'Serial no coincide';
    public $activar_boton_pagar = 0;

    public $monto_valido = 0;
    public $serial_valido = 0;
    public $activar_btn_pago = 0;




    public function render()
    {        
        $result = array();

        
        if ($this->monto_pagar > 0  and $this->monto_pagar <= $this->pendiente and is_numeric($this->monto_pagar) and $this->monto_pagar <>  '') 
            $this->monto_valido = 1;
        else 
            $this->monto_valido = 0;

        if ($this->serial == $this->input_serial)
            $this->serial_valido = 1;
        else 
            $this->serial_valido = 0;

        if ($this->monto_valido == 1 and $this->serial_valido ==1)
            $this->activar_btn_pago = 1;
        else 
            $this->activar_btn_pago = 0;
        

        
        

        


        if ($this->idticket > 0)
        {
            $this->premio       = 0;
            $this->pagado       = 0;
            $this->pendiente    = 0;

            $result = DB::table('l_ticket')
                                ->join('l_ticket_jugadas','l_ticket.idticket','=','l_ticket_jugadas.idticket')                                                                
                                ->select(   'l_ticket.idticket', 
                                            'l_ticket.serial', 
                                            DB::raw('sum(case when l_ticket_jugadas.estatus = "GAN" then l_ticket_jugadas.monto_apuesta * l_ticket_jugadas.factor else 0 end) as premio')
                                        )                                                         
                                ->where('l_ticket.idticket','=',$this->idticket)
                                ->groupBy('l_ticket.idticket', 'l_ticket.serial')
                                ->first();

            $result_pago = DB::table('l_ticket')
                                ->join('l_ticket_pagos','l_ticket.idticket','=','l_ticket_pagos.idticket')                                
                                
                                ->select(   'l_ticket.idticket', 
                                            'l_ticket.serial',                                             
                                            DB::raw('sum(l_ticket_pagos.monto) as pagado')
                                        )                    
                                ->where('l_ticket.idticket','=',$this->idticket)
                                ->groupBy('l_ticket.idticket', 'l_ticket.serial')
                                ->first();                                
                                         

            if ($result)
            {
                if ($result_pago)
                {
                    $this->pagado = $result_pago->pagado;
                }  

                $this->premio       = $result->premio;                
                $this->serial       = $result->serial;
                $this->pendiente    = $this->premio - $this->pagado;
            }
        }
        

        
        return view('livewire.vendedor.pago-ticket-animalitos-controller');
    }

    public function pagarTicket()
    {
        $pagos = new TicketPagos;
        $pagos->idticket = $this->idticket;
        $pagos->monto = $this->monto_pagar;
        if ($pagos->save())
        {
            //$this->emit('listaTicketPagar');
            return true;
        }
        else 
            return false;
        
    }

    public function UpdateIdticket($idticket)
    {
        $this->idticket = $idticket;
    }
}



