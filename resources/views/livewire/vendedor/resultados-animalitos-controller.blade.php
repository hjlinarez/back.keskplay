<div>
    <form action="">

        <div class="row">
            <div class="col-lg-4 col-sm-12 col-xs-12">
                <label for="fecha">Fecha</label>
                <input type="date" wire:model="fecha" name="fecha" id="fecha" class="form-control">
            </div>
            <div class="col-lg-8 col-sm-12 col-xs-12">
                <label for="idloteria">Loteria</label>
                <select wire:model="idloteria" name="idloteria" id="idloteria" class="form-control">
                    <option value="">Seleccione</option>
                    @foreach ($loterias as $loteria)
                        <option value="{{ $loteria->idloteria }}">{{ $loteria->nombre_loteria }}</option>
                    @endforeach
                </select>
            </div>
            
            
        </div>
    </form>
    
    <div class="row mt-2">
        @if (count($resultados) > 0)
            
        
            
        
            @foreach ($resultados as $resultado )
                <div class="col-lg-2 col-sm-12 col-xs-12 mb-1">
                    <div class="card">
                        <div class="card-header text-center">
                            {{  $resultado->hora_sorteo }}
                        </div>
                        <div class="card-body text-center p-0">
                        
                        
                        <img src="{{asset('../img/animalitos')}}/{{ $resultado->nombre_sistema }}/{{ $resultado->imagen_opcion }}" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            

            @endforeach
        @else
            <div class="alert alert-danger text-center">No hay resultados disponibles</div>
        @endif
        
    </div>

</div>
