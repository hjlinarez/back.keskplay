<div>

    <button class="btn btn-primary btn-sm " type="button" data-bs-toggle="modal"
        data-bs-target="#Edit{{ $idregistro }}"><i class="fa-solid fa-pen"></i>
    </button>


    <div class="modal fade" id="Edit{{ $idregistro }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel{{ $idregistro }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel{{ $idregistro }}">Modificar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="form{{ $idregistro }}" id="form{{ $idregistro }}">                        
                        @csrf
                        <input wire:model.defer="post.idregistro" type="hidden">
                        
                        <label for="cupo">Cupo</label>
                        <input wire:model.defer="post.cupo" type="number" class="form-control">
                        <label for="minutos">Minutos</label>

                        <select wire:model.defer="post.minutos" class="form-control">
                            <option value="0">0</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="30">30</option>
                        </select>
                        
                        <hr>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" wire:click="modificar" onclick="cerrar_modal('Edit'+{{ $idregistro }})"
                            class="btn btn-success btn-sm">Modificar
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
    function cerrar_modal(modal) {        
        bootstrap.Modal.getInstance(document.getElementById(modal)).hide();        
    }
</script>
