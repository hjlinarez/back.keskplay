<div>
    
    <div class="text-right">
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NuevoVendedor"><i class="fa-solid fa-plus"></i> Nuevo vendedor</a>
    </div>



    <div class="modal fade" id="NuevoVendedor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="Nuevo_vendedorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="Nuevo_vendedorLabel">Nuevo Vendedor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form>
                    {{ $nombre_vendedor}}
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12 ">
                                <label for="">Nombre</label>
                                <input wire:model.defer="nombre_vendedor" type="text" name="nombre_vendedor" id="nombre_vendedor" class="form-control">
                            </div>
            
                            <div class="col-lg-6 col-sm-12 col-xs-12 ">
                                <label for="">Email</label>
                                <input wire:model.defer="email_vendedor" type="email" name="email_vendedor" id="email_vendedor" class="form-control">
                            </div>
            
                        </div>
            
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12 ">
                                <label for="">Pais</label>
                                <select name="idpais" id="idpais" class="form-control" onchange="cargarEstados();">
                                    <option value="">Seleccione</option>
                                    @foreach ($paises as $pais)
                                        <option value="{{ $pais->idpais }}">{{ $pais->pais }}</option>
                                    @endforeach
                                </select>
            
                            </div>
            
                            <div class="col-lg-6 col-sm-12 col-xs-12 ">
                                <label for="">Ciudad</label>
                                <select wire:model.defer="idciudad" name="idciudad" id="idciudad" class="form-control">
                                    <option value="">Seleccione</option>
                                </select>
                                
                            </div>
            
                        </div>
            
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <label for="">Direccion</label>
                                <textarea wire:model.defer="direccion_vendedor" name="direccion_vendedor" id="direccion_vendedor" cols="" rows="3" class="form-control"></textarea>
                            </div>
            
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <label for="">Telefono</label>
                                <input wire:model.defer="telefono_vendedor" type="phone" name="telefono_vendedor" id="telefono_vendedor" class="form-control">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <label for="">Usuario</label>
                                <input wire:model.defer="usuario" type="text" name="usuario" id="usuario" class="form-control">
                                
                            </div>
            
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <label for="">Porcentaje de Venta</label>
                                <input wire:model.defer="porc_animalitos" type="number" name="porc_animalitos" id="porc_animalitos" class="form-control">
                            </div>
                        </div>
            

                </div>
                <div class="modal-footer">
                    <button type="button" onclick="validarDatos();" class="btn btn-success">Registrar</button>
                </div>

            </form>



            </div>
        </div>
    </div>
</div>




<script>
    function validarDatos()
    {
        let nombre_vendedor     = document.querySelector("#nombre_vendedor").value
        let email_vendedor      = document.querySelector("#email_vendedor").value
        let idciudad            = document.querySelector("#idciudad").value
        let direccion_vendedor  = document.querySelector("#direccion_vendedor").value
        let telefono_vendedor   = document.querySelector("#telefono_vendedor").value
        let usuario             = document.querySelector("#usuario").value
        let porc_animalitos     = document.querySelector("#porc_animalitos").value


        if (nombre_vendedor === '') {
            swal("Error", "Indique el Nombre del Vendedor", "error");
            return false;
        }

        if (email_vendedor === '') {
            swal("Error", "Indique el Email del Vendedor", "error");
            return false;
        }

        if (idciudad === '') {
            swal("Error", "Indique la Ciudad", "error");
            return false;
        }

        if (direccion_vendedor === '') {
            swal("Error", "Indique la Direccion", "error");
            return false;
        }

        if (telefono_vendedor === '') {
            swal("Error", "Indique el numero de telefono", "error");
            return false;
        }

        if (usuario === '') {
            swal("Error", "Indique el numero de telefono", "error");
            return false;
        }

        if (porc_animalitos === '') {
            swal("Error", "Indique el procentaje de ventas", "error");
            return false;
        }

        bootstrap.Modal.getInstance(document.getElementById('NuevoVendedor')).hide();
        @this.guardarVendedor();

    }

    function cargarEstados()
    {
        // se obtiene del Id del pais a seleccionar
        let idpais = document.querySelector("#idpais").value;
        // se construye la url
        let url = 'paisCiudades/'+idpais;

        fetch(url)
        .then(function(response){
            return response.json();
        })
        .then(function(jsonData){
            let ciudades = document.getElementById('idciudad');

            while (ciudades.length > 0) {                
                ciudades.remove(0);
            } 

            
            let opcion = document.createElement('option');
                opcion.value = 0;
                opcion.innerHTML = "Seleccione";
                ciudades.append(opcion);


            jsonData.forEach(function(ciudad){
                let opcion = document.createElement('option');
                opcion.value = ciudad.idciudad;
                opcion.innerHTML = ciudad.ciudad;
                ciudades.append(opcion);
            });
        });
    }


</script>