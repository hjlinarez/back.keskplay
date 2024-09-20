<div>
    <h1>Vendedor</h1>
    <hr>
    <form action="">
        <div class="row">
            <input type="hidden" name="idvendedor" value="{{ $datos->idvendedor }}">
            <div class="col-lg-6">
                <label for="">Apellidos y Nombres</label>
                <input type="text" class="form-control" value="{{ $datos->nombre_vendedor }}" disabled>
            </div>
            <div class="col-lg-6">
                <label for="">Usuario</label>
                <input type="text" value="{{ $datos->usuario }}" class="form-control" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="#" onclick=""><i class="fa-solid fa-plus"></i> Mostrar mas</a>
            </div>
        </div>
        <div style="display:none">
            <div class="row">
                <div class="col-lg-6">
                    <label for="">Direccion</label>
                    <textarea name="direccion_vendedor" id="direccion_vendedor" cols="" rows="3" class="form-control" disabled>{{ $datos->direccion_vendedor }}</textarea>
                </div>
                <div class="col-lg-6">
                    <label for="">Telefono</label>
                    <input type="text" value="{{ $datos->telefono_vendedor }}" class="form-control" disabled>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <label for="">Email</label>
                    <input type="text" value="{{ $datos->email_vendedor }}" class="form-control" disabled>
                </div>
                <div class="col-lg-6">
                    <label for="">Porcentaje de Venta</label>
                    <input type="text" value="{{ $datos->porc_animalitos }}" class="form-control" disabled>
                </div>
            </div>
        </div>
    </form>


    <hr>
    <h4>Loterias Animalitos</h4>
    @livewire('vendedor.create-loteria', ['idvendedor' => $datos->idvendedor])

    <div id="div_loterias">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>

                    <th>Loteria</th>
                    <th>Cupo</th>
                    <th>Minutos</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($loterias as $loteria)
                    <tr>
                        <td class="d-flex">
                            <button class="btn btn-danger btn-sm" type="button"
                                wire:click="eliminarLoteria({{ $loteria->idregistro }})"><i
                                    class="fa-solid fa-trash"></i></button>

                            @livewire('vendedor.edit-loteria', ['post' => json_decode(json_encode($loteria), true)], key($loteria->idregistro))
                        </td>
                        <td>{{ $loteria->nombre_loteria }}</td>
                        <td>{{ $loteria->cupo }}</td>
                        <td>{{ $loteria->minutos }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>




</div>


<script>
    function Editar() {
        bootstrap.Modal.getInstance(document.getElementById('formulario')).show();
    }
</script>
