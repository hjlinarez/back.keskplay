<div>
    <h1>Resumen de venta</h1>
    <form action="">
        <div class="row">
            <div class="col">
                <label for="desde">Desde</label>
                <input type="date" wire:model="desde" name="desde" id="desde" class="form-control">
            </div>
            <div class="col">
                <label for="desde">Hasta</label>
                <input type="date" wire:model="hasta" name="hasta" id="hasta" class="form-control">
            </div>
        </div>
    </form>

    
    <table class="table ">
        <thead>
            <tr>
                <th>Vendedor</th>
                <th class="text-end">Venta</th>
                <th class="text-end">Comision</th>
                <th class="text-end">Premios</th>
                <th class="text-end">Utilidad</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_venta = 0;
                $total_comision = 0;
                $total_premio = 0;
                $total_utilidad = 0;

            @endphp
            @foreach ( $ventas as $venta)
                @php
                    $utilidad = $venta->venta - $venta->comision - $venta->premio;
                    $total_venta += $venta->venta;
                    $total_comision += $venta->comision;
                    $total_premio += $venta->premio;
                    $total_utilidad += $utilidad;
                    
                @endphp
                <tr>
                    <td>{{ $venta->nombre_vendedor}}</td>
                    <td class="text-end">{{ number_format($venta->venta,2,',','.') }}</td>                    
                    <td class="text-end">{{ number_format($venta->comision,2,',','.') }}</td>                    
                    <td class="text-end">{{ number_format($venta->premio,2,',','.') }}</td>                    
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
</div>
