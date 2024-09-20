
<div class="container-fluid px-4">
        <h1>{{ $titulo }}</h1>
            @livewire('vendedor.create-vendedor-controller')

            
        <hr>
        
            <form action="" class="row g-3">
                <div class="col-auto col-lg-6">
                    <label for="status" class="form-label">Esatus</label>
                    <select wire:model="status" name="status" id="status" class="form-control">                
                        <option value="ACT">Activos</option>
                        <option value="BLO">Bloqueados</option>     
                        <option value="TOD">Todos</option>           
                    </select>
                </div>
                <div class="col-auto col-lg-6">
                    <label for="buscar" class="form-label">Busqueda</label>
                    <input  wire:model="buscador" id="buscar" type="text" placeholder="Indique lo que buscar..." class="form-control"/>
                </div>
            </form>      
        
        <hr>

        
        <table id="datatablesSimple" class="table table-sm table-striped">
            <tbody>
                @foreach ($vendedores as $dato)
                    <tr>
                        
                        <td>
                            <h4>{{ $dato->nombre_vendedor }} </h4> 
                            <p>
                                Email: {{ $dato->email_vendedor }}<br>
                                Telefono: {{ $dato->telefono_vendedor }}<br>
                                Direccion: {{ $dato->direccion_vendedor }}<br>
                                Usuario: {{ $dato->usuario }}<br>
                                Condicion:  @if ($dato->estatus == 'ACT') <span class="badge text-bg-success">Activo</span> @else <span class="badge text-bg-danger">Bloqueado</span> @endif
                            </p>
                            <hr class="p-0 mb-1">

                            <div class="d-flex">
                                
                                @livewire('vendedor.edit-vendedor-controller',['post' => json_decode(json_encode($dato), true)], key($dato->idvendedor)  )  

                                @if ($dato->estatus == 'ACT') 
                                    <button type="button" class="btn btn-sm btn-primary" onclick="bloquear({{ $dato->idvendedor }})"><i class="fa-solid fa-lock"></i></button>
                                @else 
                                    <button type="button" class="btn btn-sm btn-danger" wire:click="unlock({{ $dato->idvendedor }})"><i class="fa-solid fa-unlock"></i></button>
                                @endif
                                <button type="button" class="btn btn-sm btn-primary" onclick="reiniciar_password({{ $dato->idvendedor }})" ><i class="fa-solid fa-key"></i></button>

                                <a href="Vendedor-{{ $dato->idvendedor }}" class="btn btn-sm btn-primary" ><i class="fa-solid fa-list"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>

<script>


function cargarEstadosEdit(idvendedor)
    {
        // se obtiene del Id del pais a seleccionar  
         
        let idpais = document.querySelector("#formEditarVendedor_"+idvendedor).idpais.value;        
        // se construye la url
        let url = 'paisCiudades/'+idpais;
        

        fetch(url)
        .then(function(response){
            return response.json();
        })
        .then(function(jsonData){
            let ciudades = document.querySelector("#formEditarVendedor_"+idvendedor).idciudad;

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



function validarDatosEdit(idvendedor)
    {
        //let idvendedor          = document.querySelector("#formEditarVendedor_"+idvendedor).idvendedor.value;
        let nombre_vendedor     = document.querySelector("#formEditarVendedor_"+idvendedor).nombre_vendedor.value;
        let email_vendedor      = document.querySelector("#formEditarVendedor_"+idvendedor).email_vendedor.value;
        let idciudad            = document.querySelector("#formEditarVendedor_"+idvendedor).idciudad.value;
        let direccion_vendedor  = document.querySelector("#formEditarVendedor_"+idvendedor).direccion_vendedor.value;
        let telefono_vendedor   = document.querySelector("#formEditarVendedor_"+idvendedor).telefono_vendedor.value;        
        let porc_animalitos     = document.querySelector("#formEditarVendedor_"+idvendedor).porc_animalitos.value;

        //alert(nombre_vendedor); return false;
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

        

        if (porc_animalitos === '') {
            swal("Error", "Indique el procentaje de ventas", "error");
            return false;
        }

        bootstrap.Modal.getInstance(document.querySelector('#ModificarVendedor'+idvendedor)).hide();

        let parametros = JSON.stringify({
                                            "idvendedor":idvendedor,
                                            "nombre_vendedor":nombre_vendedor,
                                            "email_vendedor":email_vendedor, 
                                            "idciudad": idciudad,
                                            "direccion_vendedor": direccion_vendedor,
                                            "telefono_vendedor": telefono_vendedor,
                                            "porc_animalitos": porc_animalitos

                                        });
        
        
       
       
        @this.guardarVendedor(parametros);

    }
    function reiniciar_password(idvendedor)
    {        
        swal({
                title: "Reinicio de clave?",
                text: "Confirma que desea reiniciar la clave a este vendedor",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {                    
                    @this.reiniciar_password(idvendedor);
                    swal("La clave ha sido reiniciada, ahora el usuario puede ingresar colocando la clave generica de seis ceros (000000) ");
                } else {
                    //swal("La clave ha sido reiniciada, ahora el usuario puede ingresar colocando la clave generica de seis ceros (000000) ");
                }
            });

        
    }

    function bloquear(idvendedor)
    {        
        swal({
                title: "Bloqueo de usuario?",
                text: "Confirma que desea bloquear este vendedor",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {                    
                    @this.lock(idvendedor);
                } else {
                    //swal("Your imaginary file is safe!");
                }
            });

        
    }
</script>
