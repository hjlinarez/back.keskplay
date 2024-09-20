<div id="div_clasificacion">
    
    <select wire:model="clasificacion" name="" id="" class="form-control">        
        @foreach ($loterias_clasificacion as $item )
            <option value="{{ $item->clasificacion}}">{{ $item->clasificacion }}</option>
        @endforeach                                        
    </select>

    <div class="p-2" style="overflow:auto; height:27em">
        @if (count($sorteos) > 0)
            @foreach ($sorteos as $sorteo )
                <p class="p-0 m-1" >
                    <input 
                            type="checkbox" 
                            classs="form-check-input"        
                            wire:key="{{ $sorteo->idsorteo }} "                
                            id="{{ $sorteo->idsorteo }}" 
                            name="idsorteo[]" 
                            data_hora="{{ substr($sorteo->hora_sorteo,0,5) }}"   
                            innerText="{{ $sorteo->nombre_loteria }} - {{ $sorteo->hora_sorteo }}"
                            onclick="enfocar();"
                            value="{{ $sorteo->nombre_loteria }} - {{ $sorteo->hora_sorteo }}">
                            

                            <label class="form-check-label" for="{{ $sorteo->idsorteo }}">
                                {{ $sorteo->nombre_loteria }} - {{ $sorteo->hora_sorteo }}
                            </label>

                            
                    </p>
            @endforeach
            
        @else
            <div class="alert alert-danger text-center">No hay sorteos disponibles</div>
        @endif
        
    </div>
</div>


<script>    
    setInterval(() => {
        @this.emit('actualizarSorteos');                
    }, 10000);
</script>

<!-- Livewire Component wire-end:<component-id> -->
