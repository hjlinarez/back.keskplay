<?php
namespace App\Http\Livewire;
use Livewire\Component;

use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\IsEmpty;
use Illuminate\Support\Facades\Auth;


class HomeController extends Component
{
    public $ventas;
    
    public $premios;
    public $jackpot;
    public $utilidad;

    
    public $desde;
    public $hasta;

    public $venta_cajas;

    public $venta_operadores;

    public function mount()
    {
        $hoy = getdate();
        $dia = $hoy['mday'] < 10 ? '0'.$hoy['mday'] : $hoy['mday'];
        $mes = $hoy['mon'] < 10 ? '0'.$hoy['mon'] : $hoy['mon'];
        $ano = $hoy['year'];

    
        $this->ventas   = 0;        
        $this->premios  = 0;
        $this->jackpot  = 0;
        $this->utilidad = $this->ventas - $this->premios - $this->jackpot;
        $this->desde    = $ano.'-'.$mes.'-'.$dia;
        $this->hasta    = $ano.'-'.$mes.'-'.$dia;

        
        $this->venta_cajas = [];
        $this->venta_operadores = [];
    }
    public function render()
    {        
          
        // solo la informacion fguera de loi anulado
        $datos = DB::table('ken_ticket')
                            ->join('ken_ticket_jugadas', 'ken_ticket.idticket', 'ken_ticket_jugadas.idticket')
                            ->join('users', 'users.id', 'ken_ticket.iduser')
                            ->select(
                                        DB::raw('sum(ken_ticket_jugadas.monto) as ventas'),                                        
                                        DB::raw('sum(ken_ticket.premio_jackpot) as jackpot'),                                        
                                        DB::raw('sum(case when ken_ticket_jugadas.estatus = "GAN" then ken_ticket_jugadas.monto * ken_ticket_jugadas.factor else 0 end) as premios')
                                    )
                            
                            ->where(DB::raw('date(ken_ticket.created_at)') , '>=', $this->desde)     
                            ->where(DB::raw('date(ken_ticket.created_at)') , '<=', $this->hasta)
                            ->where('ken_ticket.estatus', '<>', 'ANU')
                            ->where('users.idopera', '=', auth::user()->id)
                            ->first();


        //VENTA DE LAS CAJAS DIRECTAS DEL OPERADOR
        $datos_caja = DB::table('ken_ticket')
                            ->join('ken_ticket_jugadas', 'ken_ticket.idticket', 'ken_ticket_jugadas.idticket')
                            ->join('users', 'users.id', 'ken_ticket.iduser')
                            ->select(   
                                    	'users.name',
                                        DB::raw('sum(ken_ticket_jugadas.monto) as ventas'),
                                        DB::raw('sum(ken_ticket.premio_jackpot) as jackpot'),
                                        DB::raw('sum(case when ken_ticket_jugadas.estatus = "GAN" then ken_ticket_jugadas.monto * ken_ticket_jugadas.factor else 0 end) as premios')
                                    )
                            
                            ->where(DB::raw('date(ken_ticket.created_at)') , '>=', $this->desde)
                            ->where(DB::raw('date(ken_ticket.created_at)') , '<=', $this->hasta)
                            ->where('ken_ticket.estatus', '<>', 'ANU')
                            ->where('users.idopera', '=', auth::user()->id)
                            ->groupBy('users.name')
                            ->get();                            
        $this->venta_cajas = $datos_caja;

        

        //VENTAS DE LOS SUBOPERADORES
        
        $datos_operadores = DB::table('users_opera')
                            ->join('users', 'users_opera.id', 'users.idopera' )
                            ->join('ken_ticket', 'ken_ticket.iduser', 'users.id')
                            ->join('ken_ticket_jugadas', 'ken_ticket.idticket', 'ken_ticket_jugadas.idticket')
                            
                            
                            ->select(   
                                    	'users_opera.name',
                                        DB::raw('sum(ken_ticket_jugadas.monto) as ventas'),
                                        DB::raw('sum(ken_ticket.premio_jackpot) as jackpot'),
                                        DB::raw('sum(case when ken_ticket_jugadas.estatus = "GAN" then ken_ticket_jugadas.monto * ken_ticket_jugadas.factor else 0 end) as premios')
                                    )
                            
                            ->where(DB::raw('date(ken_ticket.created_at)') , '>=', $this->desde)
                            ->where(DB::raw('date(ken_ticket.created_at)') , '<=', $this->hasta)
                            ->where('ken_ticket.estatus', '<>', 'ANU')
                            ->where('users_opera.idpadre', '=', auth::user()->id)
                            ->groupBy('users_opera.name')
                            ->get();   

        $this->venta_operadores = $datos_operadores;



        // RESUMEN DE LAS VENTAS GLOBALES                    
        $this->ventas = $datos_caja->sum('ventas') + $datos_operadores->sum('ventas');
        $this->premios = $datos_caja->sum('premios') + $datos_operadores->sum('premios');
        $this->jackpot = $datos_caja->sum('jackpot') + $datos_operadores->sum('jackpot');
        $this->utilidad = $this->ventas - $this->premios - $this->jackpot;

        










        
        


        return view('livewire.home-controller');
    }

}
