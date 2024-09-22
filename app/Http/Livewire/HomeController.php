<?php
namespace App\Http\Livewire;
use Livewire\Component;

use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\IsEmpty;


class HomeController extends Component
{
    public $ventas;
    
    public $premios;
    public $utilidad;

    
    public $desde;
    public $hasta;

    public $venta_cajas;

    public function mount()
    {
        $hoy = getdate();
        $dia = $hoy['mday'] < 10 ? '0'.$hoy['mday'] : $hoy['mday'];
        $mes = $hoy['mon'] < 10 ? '0'.$hoy['mon'] : $hoy['mon'];
        $ano = $hoy['year'];

    
        $this->ventas   = 0;        
        $this->premios  = 0;
        $this->utilidad = $this->ventas - $this->premios;
        $this->desde    = $ano.'-'.$mes.'-'.$dia;
        $this->hasta    = $ano.'-'.$mes.'-'.$dia;

        
        $this->venta_cajas = [];
    }
    public function render()
    {        
        
        $datos = DB::table('ken_ticket')
                            ->join('ken_ticket_jugadas', 'ken_ticket.idticket', 'ken_ticket_jugadas.idticket')
                            ->select(
                                        DB::raw('sum(ken_ticket_jugadas.monto) as ventas'),
                                        DB::raw('sum(case when ken_ticket_jugadas.estatus = "GAN" then ken_ticket_jugadas.monto * ken_ticket_jugadas.factor else 0 end) as premios')
                                    )
                            
                            ->where(DB::raw('date(ken_ticket.created_at)') , '>=', $this->desde)     
                            ->where(DB::raw('date(ken_ticket.created_at)') , '<=', $this->hasta)

                            ->first();
        $datos_caja = DB::table('ken_ticket')
                            ->join('ken_ticket_jugadas', 'ken_ticket.idticket', 'ken_ticket_jugadas.idticket')
                            ->join('users', 'users.id', 'ken_ticket.iduser')
                            ->select(   
                                    	'users.name',
                                        DB::raw('sum(ken_ticket_jugadas.monto) as ventas'),
                                        DB::raw('sum(case when ken_ticket_jugadas.estatus = "GAN" then ken_ticket_jugadas.monto * ken_ticket_jugadas.factor else 0 end) as premios')
                                    )
                            
                            ->where(DB::raw('date(ken_ticket.created_at)') , '>=', $this->desde)
                            ->where(DB::raw('date(ken_ticket.created_at)') , '<=', $this->hasta)
                            ->groupBy('users.name')
                            ->get();                            
                            
                            
        $this->ventas = $datos->ventas > 0 ? $datos->ventas : 0;
        $this->premios = $datos->premios > 0 ? $datos->premios : 0;
        $this->utilidad = $this->ventas - $this->premios;
        $this->venta_cajas = $datos_caja;


        return view('livewire.home-controller');
    }

}
