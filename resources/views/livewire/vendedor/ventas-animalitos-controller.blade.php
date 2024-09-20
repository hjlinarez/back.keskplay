<div>
    <form action="" class="form-floating">
        <div class="row">
            <div class="col">
                <label for="desde">Desde</label>
                <input wire:model="desde" type="date" class="form-control">
                  
            </div>
            <div class="col">
                <label for="hasta">Hasta</label>
                <input wire:model="hasta" type="date" class="form-control">
            </div>
        </div>                                       
    </form>
    
    <div class="table-responsive">
        @if (count($tickets) > 0)
            <table class="table table-raised">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th class="text-end">Venta</th>
                        <th class="text-end">Comision</th>
                        <th class="text-end">Premios</th>
                        <th class="text-end">Utilidades</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_venta = 0;
                        $total_comision = 0;
                        $total_premio = 0;
                        $total_utilidad = 0;

                    @endphp
                    @foreach ($tickets as $ticket )
                        @php
                            $utilidad = $ticket->venta - $ticket->comision - $ticket->premio;
                            $total_venta += $ticket->venta;
                            $total_comision += $ticket->comision;
                            $total_premio += $ticket->premio;
                            $total_utilidad += $utilidad;
                            
                        @endphp
                        <tr>
                            <td>{{ $ticket->fecha }}</td>
                            <td class="text-end">{{ number_format($ticket->venta,2,',','.') }}</td>
                            <td class="text-end">{{ number_format($ticket->comision,2,',','.') }}</td>
                            <td class="text-end">{{ number_format($ticket->premio,2,',','.') }}</td>
                            <td class="text-end">{{ number_format($utilidad,2,',','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-end">Total</th>
                        <th class="text-end">{{ number_format($total_venta,2,',','.') }}</th>
                        <th class="text-end">{{ number_format($total_comision,2,',','.') }}</th>
                        <th class="text-end">{{ number_format($total_premio,2,',','.') }}</th>
                        <th class="text-end">{{ number_format($total_utilidad,2,',','.') }}</th>
                    </tr>
                </tfoot>

            </table>
        @else     
            <div class="alert alert-danger text-center mt-5">
                No hay venta registrada en el periodo indicado.
            </div>
        @endif
        
    </div>
</div>

<script>
    function actualizarResumenVenta()
    {
        @this.actualizarResumenVenta();        
    }
</script>
