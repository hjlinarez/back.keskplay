<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function index()
    {
        //
        

        
            
            $resultado = array( 
                                "nombre_usuario"=>Auth::user()->name,
                                "ventas"=>number_format(0,2,',', '.'),
                                "comision"=>number_format(0,2,',', '.'),
                                "premios"=>number_format(0,2,',', '.'),
                                "utilidad"=>number_format(0,2,',', '.'),
                                "venta_detallada"=>0
                            );
            return view('home')->with($resultado);

        

        
    }

    public function CambiarPassword(Request $resquest)
    {
        return view('CambiarPassword');
    }


    public function grafico()
    {
        $idagente = Auth::user()->idagente;
        $datos = DB::table('l_ticket_jugadas')
                        ->join('l_ticket', 'l_ticket.idticket', '=', 'l_ticket_jugadas.idticket')
                        ->join('cha_banca_vendedores', 'cha_banca_vendedores.idvendedor', '=', 'l_ticket.idvendedor')
                        ->select(
                                    DB::raw('DATE(l_ticket.fecha_hora) as fecha'),
                                    DB::raw('SUM(l_ticket_jugadas.monto_apuesta) as total_venta')
                                )                                 
                        ->where(DB::raw('date(l_ticket.fecha_hora)'),'<',DB::raw('date(now())'))      
                        ->where('cha_banca_vendedores.idagente','=',$idagente) 
                        ->where('l_ticket.idestatusticket','<>','ANU') 
                        ->groupBy(DB::raw('DATE(l_ticket.fecha_hora)'))                        
                        ->orderByRaw('l_ticket.fecha_hora DESC')
                        ->limit(7)
                        ->get();
        foreach($datos as $dato)
        {
            $labels[] = substr($dato->fecha,5,5);
            $valores[] = $dato->total_venta*1;
        }

        
        $datos_grafico = [
                            "labels"=>$labels,
                            "data"=>$valores,
                            "max"=>max($valores)*1.2
                        ];
        return response()->json($datos_grafico);
    }
    

}
