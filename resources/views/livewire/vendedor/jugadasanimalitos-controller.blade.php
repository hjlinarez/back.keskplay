<div>
    <div class="text-end"><a href="#" onclick="borrarJugadas()">Borrar todo</a> ({{ count($jugadas) }})</div>
    
    <div style="overflow:auto; height:23em">        
        @php 
            $jugadas_new = $jugadas;
            asort($jugadas_new);
        @endphp
        {{ $loteria_actual = ''; }}

        @foreach ($jugadas_new as $i => $jugada )
            @if ($jugada["loteria"] == $loteria_actual)
                <p  class="p-0 m-0"><a href="#" onclick="borrarItem({{ $i }});"><i class="fa-solid fa-trash "></i></a> {{ $jugada["opcion"] }} x {{ $jugada["monto"] }}</p>
            @else
                @php  $loteria_actual = $jugada["loteria"] @endphp
                <p wire:key="{{ $i }}" class=" p-1 bg-success text-white m-0"> {{ $jugada["loteria"] }}</p>
                <p class="p-0 m-0"><a href="#" onclick="borrarItem({{ $i }});"><i class="fa-solid fa-trash"></i></a> {{ $jugada["opcion"] }} x {{ $jugada["monto"] }}</p>                
            @endif

        @endforeach                
    </div>
    <p class="fs-5 text-end">Pago Total: {{ number_format($pagoTotal,2,',','.') }}</p>    
</div>

<script>
    function borrarJugadas()
    {
        @this.borrarJugadas()
        enfocar();
    }

    function borrarItem(id)
    {
        
        @this.borrarItem(id)   
        enfocar();

    }
</script>
