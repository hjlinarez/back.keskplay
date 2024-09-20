<div>

    <div class="text-right">
        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ModificarVendedor{{ $idvendedor }}"><i class="fa-solid fa-pen"></i></a>
    </div>

    

    <div class="modal fade" id="ModificarVendedor{{ $idvendedor }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modificar_vendedorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modificar_vendedorLabel">Modificar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
               
                <form name="formEditarVendedor_{{ $idvendedor }}" id="formEditarVendedor_{{ $idvendedor }}">
                    <input type="hidden" name="idvendedor" id="idvendedor" value="{{ $idvendedor }}">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12 ">
                                <label for="">Nombre</label>
                                <input wire:model.defer="post.nombre_vendedor" type="text" name="nombre_vendedor" id="nombre_vendedor" class="form-control">
                            </div>
            
                            <div class="col-lg-6 col-sm-12 col-xs-12 ">
                                <label for="">Email</label>
                                <input wire:model.defer="post.email_vendedor" type="email" name="email_vendedor" id="email_vendedor" class="form-control">
                            </div>
            
                        </div>
            
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12 ">
                                <label for="">Pais</label>
                                <select name="idpais" id="idpais" class="form-control" onchange="cargarEstadosEdit({{ $idvendedor}});">
                                    <option value="">Seleccione</option>
                                    @foreach ($paises as $pais)
                                        @if ($pais->idpais == $idpais)
                                            <option value="{{ $pais->idpais }}" selected="selected">{{ $pais->pais }}</option>
                                        @else
                                            <option value="{{ $pais->idpais }}">{{ $pais->pais }}</option>
                                        @endif
                                    @endforeach
                                </select>
            
                            </div>
            
                            <div class="col-lg-6 col-sm-12 col-xs-12 ">
                                <label for="">Ciudad</label>
                                <select wire:model.defer="post.idciudad" name="idciudad" id="idciudad" class="form-control">
                                    <option value="">Seleccione</option>
                                    @foreach ($ciudades as $ciudad)
                                        @if ($ciudad->idciudad == $post["idciudad"])
                                            <option value="{{ $ciudad->idciudad }}" selected="selected">{{ $ciudad->ciudad }}</option>
                                        @else
                                            <option value="{{ $ciudad->idciudad }}">{{ $ciudad->ciudad }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                
                            </div>
            
                        </div>
            
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <label for="">Direccion</label>
                                <textarea wire:model.defer="post.direccion_vendedor" name="direccion_vendedor" id="direccion_vendedor" cols="" rows="3" class="form-control"></textarea>
                            </div>
            
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <label for="">Telefono</label>
                                <input wire:model.defer="post.telefono_vendedor" type="phone" name="telefono_vendedor" id="telefono_vendedor" class="form-control">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <label for="">Usuario</label>
                                <input type="text" disabled class="form-control" value="{{ $post->usuario}}">
                                
                            </div>
            
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <label for="">Porcentaje de Venta</label>
                                <input wire:model.defer="post.porc_animalitos" type="number" name="porc_animalitos" id="porc_animalitos" class="form-control">
                            </div>
                        </div>
            

                </div>
                <div class="modal-footer">
                    <button type="button" onclick="validarDatosEdit({{ $idvendedor }});" class="btn btn-success">Modificar</button>
                </div>

            </form>



            </div>
        </div>
    </div>
</div>




<script>
    

    


</script>