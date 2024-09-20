<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\AnimalitosTicket;
use App\Models\Vendedor;
use App\Models\AnimalitosTicketJugadas;
use Illuminate\Contracts\Session\Session;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;
USE Illuminate\Support\Facades\DB;



class TicketController extends Controller
{
    //

    public function NuevoTicket(Request $request)
    {
        
        $jugadas = session()->get('jugadas');

        if (count($jugadas) == 0)
        {        
            return response()->json(["cod"=>401,"message"=>"No hay jugadas para registrar"],201);
        }

        
        $metodo_venta_animalitos = 'POS';
        $ticket = new AnimalitosTicket;
        $ticket->serial = Str::random(5);
        $ticket->idvendedor = Auth::user()->idvendedor;
        $ticket->idmoneda = 'BSF';
        $ticket->ip = $request->ip();
        $ticket->nombre_cliente = '';
        $ticket->metodo_venta = $metodo_venta_animalitos;

        
        if ($ticket->save())
        {
            
            $registros = array();
            foreach($jugadas as $jugada)
            {
                

                //validaciones
                $idsorteo = $jugada["id"];
                $sql = DB::table('l_vendedor_loterias')
                            ->join('l_loteria_sorteos','l_vendedor_loterias.idloteria', '=', 'l_loteria_sorteos.idloteria')
                            ->select('l_vendedor_loterias.minutos')
                            ->where('l_loteria_sorteos.idsorteo', '=',$idsorteo)
                            ->where('l_vendedor_loterias.idvendedor', '=', Auth::user()->idvendedor)
                            ->first();
                $horgura = 0;
                if ($sql)
                {
                    $horgura = $sql->minutos * 100;                                        
                }


                $sql = DB::table('l_loteria_sorteos')
                            ->select('idloteria', 'hora_sorteo')
                            ->where('idsorteo','=',$idsorteo)
                            ->where('hora_sorteo','>', DB::raw('ADDTIME(time(now()),'.$horgura.')'))
                            ->first();
                
                if ($sql)
                {
                    $idloteria = $sql->idloteria;

                    // MAXIMO CUPO DE VENTA SEGUN SU AGENTE
                    $maximo_cupo_vendedor = 0;
                    $cupo_agente_loteria = DB::table('l_agentes_loterias')
                                                ->select('cupo_vendedor')
                                                ->where('idloteria', '=', $idloteria)
                                                ->where('idagente','=', Auth::user()->idagente)
                                                ->first();
                    $maximo_cupo_vendedor = $cupo_agente_loteria->cupo_vendedor;

                    // se obtiene el cuppo del vendedor por loteria
                    $maximo_opcion = 0;
                    $cupo_loteria = DB::table('l_vendedor_loterias')
                                    ->select('cupo')
                                    ->where('idloteria', '=', $idloteria)
                                    ->where('idvendedor','=', Auth::user()->idvendedor)
                                    ->first();
                    if ($cupo_loteria) $maximo_opcion = $cupo_loteria->cupo;

                    //ACUMULAOD DE LA OPCION
                    $acumulado_opcion_vendedor = 0;
                    $acumulado = DB::table('l_ticket_jugadas')
                                    ->join('l_ticket','l_ticket_jugadas.idticket', '=', 'l_ticket.idticket' )
                                    ->select(DB::raw('sum(l_ticket_jugadas.monto_apuesta) as acumulado '))
                                    ->where(DB::raw('date(l_ticket.fecha_hora)'), '=',DB::raw('date(now())'))
                                    ->where('l_ticket.idvendedor','=', Auth::user()->idvendedor)
                                    ->where('l_ticket_jugadas.idopcion','=', $jugada["idopcion"])
                                    ->where('l_ticket_jugadas.idsorteo','=', $jugada["id"])
                                    ->where('l_ticket.idestatusticket','<>', 'ANU')
                                    ->first();
                    if ($acumulado) $acumulado_opcion_vendedor = $acumulado->acumulado;

                    $restante = $maximo_cupo_vendedor - $acumulado_opcion_vendedor;  


                    if ($jugada["monto"] > $restante)
                    {
                        $jugada["monto"] = $restante;
                    }


                    //return response()->json(["cod"=>401,"message"=>"Policia"],201);
                              
                    if ($jugada["monto"] > 0)
                    {
                        $registros[] = [
                                "idticket"=>$ticket->idticket,                                
                                "fecha"=>Carbon::now(),                                
                                "idsorteo"=>$jugada["id"],
                                "idopcion"=>$jugada["idopcion"],
                                "monto_apuesta"=>$jugada["monto"],
                                "factor"=>$jugada["factor_pago"],
                                "estatus"=>'PEN',
                                "ganancia"=>0
                                ];
                    }
                        
                }
                        
                                                       
            }
            DB::Table('l_ticket_jugadas')->insert($registros);
            //$hola = AnimalitosTicketJugadas::create($registros);
            return response()->json(["cod"=>200, "data"=>["idticket"=> $ticket->idticket],"message"=>"Se creo la jugada satisfactoriamente con el ticker nro".$ticket->idticket],200);
        }
        else 
        {
            return response()->json(["cod"=>401,"message"=>"No se pudo crear la jugada"],201);
        }

        //return response()->json($ticket);
        //return [ "result"=>"Se envio la informacion"];
    }


    public function PrintTicket($idticket)
    {
        $ticket = $this->infoTicket($idticket);        
        return view('animalitos.ticket',["ticket"=>$ticket]);
    }


    public function infoTicket($idticket)
    {
        
        $jugadas_comp = DB::table('l_ticket_jugadas')
                        ->join('l_loteria_opciones','l_ticket_jugadas.idopcion', '=', 'l_loteria_opciones.idopcion')
                        ->join('l_loteria','l_loteria_opciones.idloteria', '=', 'l_loteria.idloteria')
                        ->join('l_loteria_sorteos', 'l_ticket_jugadas.idsorteo', '=', 'l_loteria_sorteos.idsorteo')                        
                        ->where('l_ticket_jugadas.idticket', '=', $idticket)
                        ->select(
                                'l_loteria.idloteria', 
                                'l_loteria.nombre_loteria', 
                                'l_ticket_jugadas.fecha',
                                'l_loteria_sorteos.hora_sorteo', 
                                'l_loteria_sorteos.idsorteo',
                                'l_ticket_jugadas.monto_apuesta'
                            )
                        ->groupBy(
                            'l_loteria.idloteria', 
                                'l_loteria.nombre_loteria', 
                                'l_ticket_jugadas.fecha',
                                'l_loteria_sorteos.hora_sorteo', 
                                'l_loteria_sorteos.idsorteo',
                                'l_ticket_jugadas.monto_apuesta'
                        )
                        ->get();
        //$jugadas_com_new = array();

        foreach($jugadas_comp as $jugada)
        {
            $opciones = DB::table('l_ticket_jugadas')
                        ->join('l_loteria_opciones', 'l_ticket_jugadas.idopcion', '=', 'l_loteria_opciones.idopcion')
                        ->select(
                                    'l_loteria_opciones.numero_opcion', 
                                    'l_loteria_opciones.nombre_opcion'
                                )
                        ->where('l_ticket_jugadas.idticket', '=', $idticket)
                        ->where('l_ticket_jugadas.idsorteo', '=', $jugada->idsorteo)
                        ->where('l_ticket_jugadas.monto_apuesta', '=', $jugada->monto_apuesta)
                        ->get();
            $jugada->opciones = $opciones;
            //$jugadas_com_new[] = $jugada;
        }

        $jugadas = DB::table('l_ticket_jugadas')
                        ->join('l_loteria_opciones','l_ticket_jugadas.idopcion', '=', 'l_loteria_opciones.idopcion')
                        ->join('l_loteria','l_loteria_opciones.idloteria', '=', 'l_loteria.idloteria')
                        ->join('l_loteria_sorteos', 'l_ticket_jugadas.idsorteo', '=', 'l_loteria_sorteos.idsorteo')                        
                        ->where('l_ticket_jugadas.idticket', '=', $idticket)
                        ->select(
                                'l_loteria.nombre_loteria', 
                                'l_ticket_jugadas.fecha',
                                'l_loteria_sorteos.hora_sorteo', 
                                'l_loteria_opciones.numero_opcion',
                                'l_loteria_opciones.nombre_opcion',
                                'l_ticket_jugadas.monto_apuesta',
                                'l_ticket_jugadas.factor',
                                'l_ticket_jugadas.estatus',
                                'l_ticket_jugadas.ganancia',
                                DB::raw('(case when l_ticket_jugadas.estatus = \'GAN\' then l_ticket_jugadas.monto_apuesta * l_ticket_jugadas.factor else 0 end) as monto_premio'),
                                DB::raw('sum(case when l_ticket_jugadas.estatus = \'PEN\' then 1 else 0 end) as pendiente'),
                                DB::raw('sum(case when l_ticket_jugadas.estatus = \'GAN\' then 1 else 0 end) as ganadora'),
                                DB::raw('sum(case when l_ticket_jugadas.estatus = \'PER\' then 1 else 0 end) as perdedora')
                            )
                        ->groupBy(
                            'l_loteria.nombre_loteria', 
                            'l_ticket_jugadas.fecha',
                            'l_loteria_sorteos.hora_sorteo', 
                            'l_loteria_opciones.numero_opcion',
                            'l_loteria_opciones.nombre_opcion',
                            'l_ticket_jugadas.monto_apuesta',
                            'l_ticket_jugadas.factor',
                            'l_ticket_jugadas.estatus',
                            'l_ticket_jugadas.ganancia'
                        )
                        ->get();

        
           
        $ticket = DB::table('l_ticket')
                        ->join('cha_banca_vendedores', 'cha_banca_vendedores.idvendedor', '=', 'l_ticket.idvendedor' )                            
                        ->join('cha_banca_agentes','cha_banca_agentes.idagente', '=', 'cha_banca_vendedores.idagente')
                        ->join('cha_banca_operador', 'cha_banca_operador.idoperador', '=', 'cha_banca_agentes.idoperador')
                        ->where('l_ticket.idticket', '=', $idticket)
                        ->select(
                                'cha_banca_operador.nombre_operador',
                                'cha_banca_agentes.nombre_agente', 
                                'cha_banca_vendedores.nombre_vendedor',
                                'cha_banca_vendedores.fuente_impresion',
                                'cha_banca_vendedores.formato_ticket',
                                'cha_banca_vendedores.font_size',
                                'cha_banca_operador.pie_ticket',
                                'l_ticket.idvendedor',
                                'l_ticket.idticket',
                                'l_ticket.serial',
                                'l_ticket.nombre_cliente',
                                'l_ticket.ip',
                                'l_ticket.metodo_venta',
                                'l_ticket.idestatusticket',
                                'l_ticket.idestatusticket as estatus',
                                DB::raw('(select sum(monto) from l_ticket_pagos where l_ticket_pagos.idticket = l_ticket.idticket) as pagado'),
                                DB::raw('CONCAT(DATE_FORMAT(date(l_ticket.fecha_hora),\'%d/%m/%Y\'), \' \', TIME(l_ticket.fecha_hora)) as fecha_hora')
                                )
                                ->first();

        $monto_total= 0;
        foreach($jugadas as $jugada)
        {
            $monto_total += $jugada->monto_apuesta;
        }        
        $ticket->monto_total = $monto_total;

        $ticket->jugadas = $jugadas;

        $ticket->jugadas_formato_comprimido = $jugadas_comp;
        return $ticket;

    }

    public function TicketPrint($idticket)
    {
        $vendedor = Vendedor::where('idvendedor', Auth::user()->idvendedor)->first();
        $lineas = array();        
        $ticket             = $this->infoTicket($idticket);        
        $ticket->url      = 'https://apuestaya.bet/animalitos-'.$idticket;   
        


        //$lineas[]    = array('titulo'=>'INFORMACION TICKET','contenido'=>'');
        $lineas[]    = array('titulo'=>'','contenido'=>$ticket->nombre_vendedor);
        $lineas[]    = array('titulo'=>'Ticket: '.$ticket->idticket.' Serial: '.$ticket->serial,'contenido'=>'');
        $lineas[]    = array('titulo'=>'Fecha - Hora: ','contenido'=>substr($ticket->fecha_hora,0,16));
        $lineas[]    = array('titulo'=>'Pago Total: ','contenido'=>$ticket->monto_total);

        $idsorteo_actual = 0;
        foreach ($ticket->jugadas as $jugada)
        {
           
                $lineas[]    = array('titulo'=>'--------------------','contenido'=>'');
                //$contenido = $jugada["nombre_loteria"].' ('.$jugada["fecha"].' '.$jugada["hora_sorteo"].')';
                $contenido = $jugada->nombre_loteria.' - '.$jugada->hora_sorteo;
                $lineas[]    = array('titulo'=>'','contenido'=>$contenido);  
               


                $lista_opciones = '(';
                $coma = ' ';
                $cantidad = 0;
                foreach($jugada["opciones"] as $opcion)
                {
                    $cantidad +=1;
                    
                    $lista_opciones .= $opcion["numero_opcion"].'-'.substr($opcion["nombre_opcion"],0,3).$coma;
                    /*if ($cantidad == 4)
                    {
                        $lineas[]    = array('titulo'=>'','contenido'=>$lista_opciones);  
                        $lista_opciones = '';
                        $cantidad = 0;
                    }*/
                }
                $lineas[]    = array('titulo'=>'','contenido'=>$lista_opciones.')'.' X '.$jugada["monto_apuesta"]);  

          
                               
        }
        $lineas[]    = array('titulo'=>'--------------------','contenido'=>'');
        $contenido      = $ticket["pie_ticket"];
        $lineas[]       = array('titulo'=>'','contenido'=>$contenido);

        return $lineas;
    }


    public function ListaTicketAnular()
    {
        $tiempo = 600;
        $lista = DB::table('l_ticket')
                        ->join('l_ticket_jugadas','l_ticket.idticket','=', 'l_ticket_jugadas.idticket')
                        ->select('l_ticket.idticket', 'l_ticket.fecha_hora', DB::raw('sum(l_ticket_jugadas.monto_apuesta ) as monto'))                        
                        ->where('idvendedor','=', Auth::user()->idvendedor)                        
                        ->where(DB::raw('TIME_TO_SEC(TIMEDIFF(now(),l_ticket.fecha_hora))'), '<', $tiempo)
                        ->where('l_ticket.idestatusticket', '<>', 'ANU')
                        ->groupBy('l_ticket.idticket', 'l_ticket.fecha_hora')
                        ->orderby('l_ticket.idticket','desc')
                        ->get();
        
        return response()->json($lista);
    }

    public function anularTicket(Request $request)
    {
        $idticket = $request["idticket"];
        $tiempo = 600;
        $affected = DB::table('l_ticket')
                            ->where('idticket', $idticket)
                            ->where('idvendedor',Auth::user()->idvendedor)
                            ->where(DB::raw('TIME_TO_SEC(TIMEDIFF(now(),fecha_hora))'), '<', $tiempo)
                            ->update(['idestatusticket'=>'ANU', 'fecha_hora_anula'=>Carbon::now()]);

        if ($affected)
        {
            return response()->json(["cod"=>200,"message"=>"Ticket anulado satisfactoriamente"],200);
        }
        else 
        {
            return response()->json(["cod"=>401,"message"=>"No se pudo eliminar el ticket"],401);
        }

    }

}
