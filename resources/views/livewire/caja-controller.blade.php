<div>
    <h1>Cajas</h1>
      
    <a href="NuevaCaja" class="btn btn-success btn-sm">Nueva Caja</a>
    <hr>
            <input type="text" class="form-control" placeholder="Buscar" wire:model="filtro">
            <select name="" id="" class="form-control mt-1" wire:model="estatus">
                <option value="ALL">Todos</option>
                <option value="ACT">Solo Activos</option>
                <option value="BLO">Bloqueados</option>   
            </select>
            @foreach ($data as $dato ) 

                <div class="card text-start mt-1">
                    
                    <div class="{{ $dato->estatus == 'BLO' ? 'card-header bg-danger text-white' : 'card-header'}}">{{ $dato->name }} {{ $dato->estatus == 'BLO' ? '(Bloqueado)' : ''}} </div>
                    <div class="card-body">                        
                        Usuario: {{ $dato->login }}<br>
                        Telefono:<br>
                        Direccion: <br> 
                        Email: {{ $dato->email }}  
                    </div>
                    <div class="card-footer">
                        

                        @if ($dato->estatus == 'BLO')
                            <button class="btn btn-sm btn-success">Desbloquear</button>
                        @else
                            <button type="button" class="btn btn-sm btn-primary" wire:click="editcaja({{ $dato }});" >Modificar</button>
                            <button class="btn btn-sm btn-danger">Bloquear</button>
                            <button class="btn btn-sm btn-primary">Parametros</button>
                            <button class="btn btn-sm btn-primary">Recarga de Saldo</button>
                        @endif


                        
                        
                    </div>
                </div>

               
            @endforeach
       

            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Modificar Caja</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <form action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="name"  wire:model.defer="caja.name"  placeholder="Indique el nombre de la Caja" />
                                </div>
                    
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Correo Electronico</label>
                                    <input type="email" class="form-control" id="email"  wire:model.defer="caja.email" placeholder="abc@mail.com"/>
                                </div>
                            </div>
                    
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" id="login"  disabled wire:model.defer="caja.login" />
                                </div>
                    
                                
                            </div>
                            <hr>
                            <h5>Config Keno</h5>
                    
                            <div class="row">
                                <div class="col">
                                    <label for="apuesta_minima" class="form-label">Apuesta Minima</label>
                                    <input type="number" class="form-control" id="apuesta_minima" wire:model.defer="caja.apuesta_minima" placeholder=""/>
                                </div>
                    
                                <div class="col">
                                    <label for="apuesta_maxima" class="form-label">Apuesta Maxima</label>
                                    <input type="number" class="form-control" id="apuesta_maxima" wire:model.defer="caja.apuesta_maxima"/>
                                </div>
                    
                                <div class="col">
                                    <label for="apuesta_maxima" class="form-label">Opciones de Pago</label>
                                    <input type="text" class="form-control" id="pagos" wire:model.defer="caja.pagos" placeholder="Ej: 100,200,300"/>
                                </div>
                    
                            </div>
                    
                            <hr>
                            <h5>Jackpot</h5>
                    
                            <div class="row mt-2">
                    
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">Mini</div>
                                        <div class="card-body">
                                            
                                            <label for="acumulado_mini_jackpot " class="form-label">Monto Inicial</label>
                                            <input type="number" class="form-control" id="acumulado_mini_jackpot" wire:model.defer="caja.acumulado_mini_jackpot"/>
                    
                                            <label for="porc_mini_jackpot" class="form-label">% Recoleccion</label>
                                            <input type="number" class="form-control" id="porc_mini_jackpot" wire:model.defer="caja.porc_mini_jackpot"/>
                    
                                            <label for="limite_mini_jackpot" class="form-label">Lim. Entrega</label>
                                            <input type="number" class="form-control" id="limite_mini_jackpot" wire:model.defer="caja.limite_mini_jackpot"/>
                    
                                            <label for="porc_entrega_mini_jackpot" class="form-label">% Entrega</label>
                                            <input type="number" class="form-control" id="porc_entrega_mini_jackpot" wire:model.defer="caja.porc_entrega_mini_jackpot"/>
                                            
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">Super</div>
                                        <div class="card-body">
                                            <label for="acumulado_super_jackpot " class="form-label">Monto Inicial</label>
                                            <input type="number" class="form-control" id="acumulado_super_jackpot" wire:model.defer="caja.acumulado_super_jackpot"/>
                    
                                            <label for="porc_super_jackpot" class="form-label">% Recoleccion</label>
                                            <input type="number" class="form-control" id="porc_super_jackpot" wire:model.defer="caja.porc_super_jackpot" />
                    
                                            <label for="limite_super_jackpot" class="form-label">Lim. Entrega</label>
                                            <input type="number" class="form-control" id="limite_super_jackpot" wire:model.defer="caja.limite_super_jackpot" />
                    
                                            <label for="porc_entrega_super_jackpot" class="form-label">% Entrega</label>
                                            <input type="number" class="form-control" id="porc_entrega_super_jackpot" wire:model.defer="caja.porc_entrega_super_jackpot" />
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">Mega</div>
                                        <div class="card-body">
                                            <label for="acumulado_mega_jackpot " class="form-label">Monto Inicial</label>
                                            <input type="number" class="form-control" id="acumulado_mega_jackpot" wire:model.defer="caja.acumulado_mega_jackpot"/>
                    
                                            <label for="porc_mega_jackpot" class="form-label">% Recoleccion</label>
                                            <input type="number" class="form-control" id="porc_mega_jackpot" wire:model.defer="caja.porc_mega_jackpot"/>
                    
                                            <label for="limite_mega_jackpot" class="form-label">Lim. Entrega</label>
                                            <input type="number" class="form-control" id="limite_mega_jackpot" wire:model.defer="caja.limite_mega_jackpot"/>
                    
                                            <label for="porc_entrega_mega_jackpot" class="form-label">% Entrega</label>
                                            <input type="number" class="form-control" id="porc_entrega_mega_jackpot" wire:model.defer="caja.porc_entrega_mega_jackpot"/>
                                        </div>
                                    </div>
                                </div>
                    
                            </div>
                            
                            
                            
                            
                        </form>
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button  type="button" class="btn btn-primary" wire:click.prevent=GuardarCaja>Modificar</button>
                    </div>
                  </div>
                </div>
              </div>
        
</div>

<script>

    document.addEventListener('livewire:load', function () {


        Livewire.on('open_modal', () => {  

                $('#staticBackdrop').modal('show');

            });


        Livewire.on('close_modal', () => {  
                $('#staticBackdrop').modal('toggle'); 
            });


        Livewire.on('mensaje', (titulo, mensaje, tipo) => { 
                swal(titulo, mensaje, tipo);
            } );

        

                       
        
    });

</script>



