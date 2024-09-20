    <div>
        
        <div class="input-group">       
            <input class="form-control mt-1 mb-1" type="text" placeholder="Buscar ticket"  wire:model.defer="idticket"/>        
            <button class="btn btn-primary  mt-1 mb-1"  type="button" wire:click="consultaTicket" ><i class="fas fa-search"></i></button>
        </div>

        @if ($ticket)
            @php
                echo ($ticket->idestatusticket == 'ANU') ? "<p class='fs-5 text-center fw-bold text-danger'>Anulado ($ticket->fecha_hora_anula)</p>" : '';
            @endphp
            <strong>Ticket: </strong> {{ $idticket }}  <strong>Fecha: </strong> {{ $ticket->fecha_hora  }}<br>
            <strong>Cant. Jugadas: </strong> {{ count($jugadas) }}  <strong>Total Apuesta: </strong> {{ number_format($monto_total,2,',','.')  }}<br>
            <strong>Total Premio: </strong> {{ number_format($premio,2,',','.')  }}<br>
            <strong>Total pagado: </strong> {{ number_format($premio_pagado,2,',','.')  }} <br>
            <strong>Total pendiente: </strong> {{ number_format($pendiente,2,',','.')  }} 
            
            <hr>
            <h6>Jugadas</h6>
            <div style="height: 250px; overflow:auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Loteria / Sorteo / Opcion / Apuesta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jugadas as $jugada)
                            <tr>
                                <td>
                                    {{ $jugada->nombre_loteria }} / {{  $jugada->hora_sorteo }} / <strong>({{ $jugada->numero_opcion }})-{{ $jugada->nombre_opcion }}</strong> x {{ number_format($jugada->monto_apuesta,2,',','.') }}


                                    @if ($jugada->estatus == 'GAN')
                                        @php
                                            echo "<span class='badge bg-success' >Ganador (". number_format($jugada->factor * $jugada->monto_apuesta,2,',','.').")</span>";
                                        @endphp                                        
                                    @elseif ($jugada->estatus == 'PER')
                                        @php echo "<span class='badge bg-danger' >Perdedor</span>"; @endphp
                                    @else
                                        @php echo "<span class='badge bg-primary' >Pendiente</span>"; @endphp
                                    @endif

                                    
                                </td>
                            </tr>    
                        @endforeach
                        
                    </tbody>

                </table>
            </div>
        @else
            @if ($idticket>0)
                <div class="alert alert-danger text-center">Numero de ticket no existe!!!</div>
            @endif
        @endif    
            

        
    </div>
