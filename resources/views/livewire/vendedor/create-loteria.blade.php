<div>
    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#formulario" onclick="Nuevo()" >
        <i class="fa-solid fa-plus"></i> Agregar
    </button>

    <div class="modal fade" id="formulario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Loteria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <label for="idloteria">Loteria</label>
                        <select wire:model.defer="idloteria" name="idloteria" id="idloteria" class="form-control">
                            <option value="">Seleccione</option>
                            @foreach ($loteriasDisponibles as $item)
                                <option value="{{ $item['idloteria'] }}">{{ $item['nombre_loteria'] }}</option>
                            @endforeach

                        </select>
                        <label for="cupo">Cupo</label>
                        <input wire:model.defer="cupo" type="number" id="cupo" name="cupo"
                            class="form-control">
                        <label for="minutos">Minutos</label>
                        <input wire:model.defer="minutos" type="number" id="minutos" name="minutos"
                            class="form-control">
                        <hr>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" onclick="validar()"
                            class="btn btn-success btn-sm">Agregar
                        </button>
                    </form>

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


</div>
<script>
    function Nuevo() {
        document.querySelector("#idloteria").value = "";
        document.querySelector("#cupo").value = "";
        document.querySelector("#minutos").value = "";
        
    }

    function validar() {
        
        let idloteria = document.querySelector("#idloteria").value
        let cupo = document.querySelector("#cupo").value
        let minutos = document.querySelector("#minutos").value

        if (idloteria === '') {
            swal("Error", "Indique la Loteria", "error");
            return false;
        }

        if (cupo === '') {
            swal("Error", "Indique el monto del cupo", "error");
            return false;
        }


        bootstrap.Modal.getInstance(document.getElementById('formulario')).hide();
        @this.guardar();
        

    }
</script>
