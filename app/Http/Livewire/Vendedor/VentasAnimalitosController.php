<?php

namespace App\Http\Livewire\Vendedor;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class VentasAnimalitosController extends Component
{
    public $desde ;
    public $hasta;
    public $tickets;
    protected $listeners = ['actualizarResumenVenta'];
    public function mount()
    {
        $this->desde = Carbon::now()->format('Y-m-d');
        $this->hasta = Carbon::now()->format('Y-m-d');
    }

    public function render()
    {

        $this->tickets = DB::table('l_ticket')
                        ->join('l_ticket_jugadas','l_ticket.idticket','=', 'l_ticket_jugadas.idticket')
                        ->join('cha_banca_vendedores','l_ticket.idvendedor','=', 'cha_banca_vendedores.idvendedor')
                        ->select(
                                    
                                    DB::raw('DATE_FORMAT(DATE(l_ticket.fecha_hora), "%d/%m/%Y")  as fecha'),
                                    DB::raw('sum(l_ticket_jugadas.monto_apuesta) as venta'), 
                                    DB::raw('sum(l_ticket_jugadas.monto_apuesta * (cha_banca_vendedores.porc_animalitos / 100)) as comision'), 
                                    DB::raw('sum(case when l_ticket_jugadas.estatus = "GAN" then l_ticket_jugadas.monto_apuesta * l_ticket_jugadas.factor else 0 end) as premio')                                     
                                )
                        ->where(DB::raw('date(l_ticket.fecha_hora)'),'>=', $this->desde)
                        ->where(DB::raw('date(l_ticket.fecha_hora)'),'<=', $this->hasta)
                        ->where('l_ticket.idvendedor','=', auth::user()->idvendedor)
                        ->where('l_ticket.idestatusticket','<>', 'ANU')
                        ->groupby(DB::raw('DATE_FORMAT(DATE(l_ticket.fecha_hora), "%d/%m/%Y") '))
                        ->get();
        return view('livewire.vendedor.ventas-animalitos-controller');
    }

    public function actualizarResumenVenta()
    {
        $this->desde = Carbon::now()->format('Y-m-d');
        $this->hasta = Carbon::now()->format('Y-m-d');
    }
}
