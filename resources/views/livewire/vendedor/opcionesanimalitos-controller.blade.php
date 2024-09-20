<div>
    <div class="row">
        @foreach ($opciones as $item)
            <div class="col-lg-3">
                <button 
                    type="button" 
                    onclick="seleccionarOpcion(this);"
                    class="btn btn-outline-primary btn-sm form-control  mb-1 p-1 text-start" 
                    nameopcion="({{ $item->numero_opcion }}) {{ $item->nombre_opcion }}"                     
                    id="BTN-{{ $item->numero_opcion }}"                     
                    alt="({{ $item->numero_opcion }}) {{ $item->nombre_opcion }}"
                >
                    <span class="fs-6">{{ $item->numero_opcion }} - {{ substr($item->nombre_opcion, 0, 4) }}</span>
                </button>
            </div>
        @endforeach
    </div>
</div>
