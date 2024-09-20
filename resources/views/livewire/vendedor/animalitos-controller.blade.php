<div>
    <form action="" class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    
        @csrf
        <div id="div_principal" class="container-fluid">

            <div class="row mt-2">
                <div class="col-lg-6 h4">Animalitos</div>
                <div class="col-lg-6 text-end">                                               
                    @livewire('vendedor.botones-animalitos-controller' )
                </div>
            </div>
            
            <div class="row mt-2">
                <div class="col-lg-4 col-sm-12 col-xs-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Sorteos
                        </div>
                        <div class="card-body" >
                            @livewire('vendedor.clasificacionanimalitos-controller' )
                        </div>
                    </div>
                </div>
        
        
                <div class="col-lg-5 col-sm-12 col-xs-12 col-md-12">
                    <div class="card">
                        <div class="card-header">Opciones</div>
                        <div class="card-body" >
                            
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" id="opcion" name="opcion" placeholder="Opciones">
                                        (.) + Enter = Imprimir 
                                    </div>

                                    <div class="col">
                                        <input type="text" class="form-control" id="monto" name="monto" placeholder="Monto" >
                                    </div>

                                    <div class="col">
                                        <button id="btn_agregar" type="button" onclick="agregarJugada(); return false;" class="btn btn-success">Agregar</button>
                                    </div>
                                </div>
                            

                            <div id="opciones" class="mt-2" style="overflow:auto; height:26.5em">
                                @livewire('vendedor.opcionesanimalitos-controller' )
                            </div>

                        </div>
                    </div>
                </div>
        
                <div class="col-lg-3 col-sm-12 col-xs-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Jugadas
                        </div>
                        <div class="card-body" style="overflow:auto">
                            @livewire('vendedor.jugadasanimalitos-controller' )
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-success form-control" onclick="crearTicket();">Imprimir</button>
                        </div>
                        
                    </div>
                </div>
                
        
            </div>
        </div>
    
    </form>


    <div id="div_imprimir" style="display:none"></div>



    <div class="modal fade" id="ModalAnularTicket" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalAnularTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalAnularTitle">Anular tickets</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="ModalAnularBody" class="modal-body" style="height: 350px; overflow:auto">
                    @livewire('vendedor.anular-ticket-animalitos-controller')
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>          
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="ModalPagarTicket" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalPagarTicketTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="ModalPagarTicketTitle">Pagar Ticket</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="ModalPagarTicketBody" class="modal-body" style="height: 350px; overflow:auto">
                @livewire('vendedor.pagar-ticket-animalitos-controller')            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>          
            </div>
        </div>
        </div>
    </div>



    <div class="modal fade" id="ModalVentasLive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalVentasTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="ModalVentasTitle">Resumen de ventas</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="ModalVentasBody" class="modal-body" style="height: 350px; overflow:auto">
                @livewire('vendedor.ventas-animalitos-controller')
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>          
            </div>
        </div>
        </div>
    </div>




    <div class="modal fade" id="ModalPagoTicket" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalPagoTicketTitle" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="ModalPagoTickettTitle">Pagar Ticket</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="ModalPagarTicketBody" class="modal-body">
                @livewire('vendedor.pago-ticket-animalitos-controller')            
            </div>
            
        </div>
        </div>
    </div>


    <div class="modal fade" id="ModalResultados" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalResultadosTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="ModalResultadosTitle">Resultados</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="ModalResultadosBody" class="modal-body" style="height: 350px; overflow:auto">
                @livewire('vendedor.resultados-animalitos-controller')
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>          
            </div>
        </div>
        </div>
    </div>


    <div class="modal fade" id="ModalConfiguracion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalConfiguracionTitle" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="ModalConfiguracionTitle">Configuracion</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="ModalConfiguacionBody" class="modal-body">
                    <label for="idimpresion">Formato de Impresion</label>
                    <select name="idimpresion" id="idimpresion" class="form-control" wire:model.defer="formato_ticket">
                        @foreach ($formatoTicket as $formato )
                            <option value="{{ $formato }}" {{ $formato == $formato_ticket ? "Selected" : "" }}>{{ $formato }}</option>    
                        @endforeach                    
                    </select>
                    <label for="idimpresion">Fuente</label>                
                    <select  wire:model.defer="font_size" class="form-control" >
                        @foreach ($fuentes as $fuente )
                            <option value="{{ $fuente }}" {{ $fuente == $font_size ? "Selected" : "" }}>{{ $fuente }} </option>    
                        @endforeach                                        
                    </select>                        
            </div>
            <div class="modal-footer">
            <button type="button" wire:click="GuadarConfiguracion" class="btn btn-secondary" data-bs-dismiss="modal" >Guardar</button>          
            </div>
        </div>
        </div>
    </div>





    <div class="modal fade" id="ModalConsulta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalConsultaTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalConfiguracionTitle">Consulta de Ticket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="ModalConsultaBody" class="modal-body">            
                    @livewire('vendedor.consulta-ticket-controller') 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Cerrar</button>          
                </div>
            </div>
        </div>
    </div>


  


    
</div>




<script>
    
    
    $("#ModalAnularTicket").on('show.bs.modal', function () {                    
        @this.emit('listaTicketAnular');        
    });  

    $("#ModalPagarTicket").on('show.bs.modal', function () {            
        @this.emit('ActualizarlistaTicketPagar');        
    });  

    $("#ModalPagarTicket").on('hide.bs.modal', function () {                 
        @this.emit('ActualizarlistaTicketPagar');                
    });  
   
    $("#ModalVentasLive").on('show.bs.modal', function () {            
        actualizarResumenVenta();                
    });  

    $("#ModalVentasLive").on('hide.bs.modal', function () {            
        actualizarResumenVenta();                
    });  


    $("#ModalResultados").on('hide.bs.modal', function () {                    
        @this.emit('IniciarResultados');     
        
    });  



    function consultaticket()
    {
        alert("hola");
        @this.emit('consultaTicket(5)');
    }

    function pagarTicket(idticket)
    {        

        //document.querySelector("#idticketPagar").value = "123";
        $("#ModalPagarTicket").modal('hide');
        $("#ModalPagoTicket").modal('show');
        inicializarPagar(idticket);
    }

  


    function imprimir()
    {
        document.querySelector("#div_imprimir").innerHTML= '<iframe src="aniprint-192535"></iframe>';
    }

    
    function crearTicket()
    {                
        let data = { };
        
        let url = "api/NuevoTicket";

        fetch(url, {
            headers:{
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    method:'POST',
                    body: JSON.stringify(data)
                    }
                )
            .then(response => response.json())
            .then(function(result){
                    if (result.cod == 200)
                    {
                        borrarJugadas();               
                        //@this.refrescarSorteos();    
                        
                        @this.emit('actualizarSorteoss');                      
                        @this.emit('ActualizarBotones');                      
                        
                        document.querySelector("#div_imprimir").innerHTML= '<iframe src="Ticket-'+result.data.idticket+'"></iframe>';
                        
                    }
                    else{
                        
                        swal("Lo siento!", result.message, "error");
                        
                    }
                    
                })
            .catch(function (error) {
                    
                    console.log(error);
            });
    }




    function reiniciarJugadas()
    {        
        borrarJugadas();
        document.getElementById("opcion").value='';
        document.getElementById("opcion").monto='';
    }



    function enfocar()
    {
        document.getElementById("opcion").focus();
    }

    function seleccionarOpcion(objeto)
    {        
        
        let opcion = document.querySelector('#opcion').value = objeto.id.substring(4);
        agregarJugada();
    }

    function agregarJugada()
    {
        
        let opcion = document.querySelector('#opcion').value;        
        let monto = document.querySelector('#monto').value;
        let idsorteos = document.querySelectorAll("input[name='idsorteo[]']:checked");
        let nameopcion;
        let idopcion;

        

        
        if (document.getElementById('BTN-'+opcion) == null) {
            swal("Disculpe", "La opcion "+opcion+" no existe", "error");
            return;            
        }
        else {
            nameopcion = document.getElementById('BTN-'+opcion).getAttribute('alt');    
            //idopcion = document.getElementById('BTN-'+opcion).name;    
        }

        

        if (idsorteos.length == 0) 
        {
            swal({
                title:"Error",
                text: "Por favor, debe seleccionar al menos un sorteo.",
                type: "error"
            });
            return;
        }

        if (monto.length == 0)
        {
            swal({
                title:"Error",
                text: "El campo monto es invalido",
                type: "error"
            });
            return;
        }

        if (opcion.length == 0)
        {
            swal({
                title:"Error",
                text: "Por favor indique una opcion",
                type: "error"
            });
            return ;
        }

        let loterias = [];
        Array.prototype.forEach.call(idsorteos, function (item) {
            //item.checked = true;
            //console.log(item.checked);
            loterias.push({'idsorteo':item.id,'loteria':item.value});


            
        });

        //console.log(nameopcion);
        //return;
        
        
        let parametros = JSON.stringify({"opcion":opcion,"nameopcion":nameopcion,"monto":monto, "idsorteos": loterias});
        
        
        @this.agregarJugada(parametros);


        
        document.getElementById("opcion").value='';
        document.getElementById("opcion").focus();
        //alert(opcion);
    }


    

    

    

    function resultados()
    {
        $("#ModalTitle").text("Resultados");
        $('#Modal').modal('show');
    }

    var input = document.getElementById("monto");
    var input2 = document.getElementById("opcion");

    // Execute a function when the user presses a key on the keyboard
    input.addEventListener("keypress", function(event) {
            // If the user presses the "Enter" key on the keyboard
            if (event.key === "Enter") {
                // Cancel the default action, if needed
                    event.preventDefault();
                    // Trigger the button element with a click
                    document.getElementById("btn_agregar").click();
                    
                }
            });

    input2.addEventListener("keypress", function(event) {
            // If the user presses the "Enter" key on the keyboard
            if (event.key === "Enter") {
                    // Cancel the default action, if needed
                    if (document.getElementById("opcion").value == '.')
                    {
                        alert("imprimir");
                        reiniciarJugadas();
                    }
                    else 
                    {
                        event.preventDefault();
                        // Trigger the button element with a click
                        document.getElementById("monto").focus();
                    }
                    
                    
                }
            });


</script>
