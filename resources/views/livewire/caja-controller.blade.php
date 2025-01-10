<div>
    <h1>Cajas</h1>      
        
        @livewire('newcaja-controller')    
    <hr>
            <input type="text" class="form-control" placeholder="Buscar" wire:model="filtro">
            <select name="" id="" class="form-control mt-1" wire:model="estatus">
                <option value="ALL">Todos</option>
                <option value="ACT">Solo Activos</option>
                <option value="BLO">Bloqueados</option>   
            </select>

            <div class="row">
            @foreach ($data as $dato ) 
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="card text-start mt-1">
                        
                        <div class="{{ $dato->estatus == 'BLO' ? 'card-header bg-danger text-white' : 'card-header fw-bold'}}">{{ $dato->name }} {{ $dato->estatus == 'BLO' ? '(Bloqueado)' : ''}} </div>
                        <div class="card-body">                        
                            Usuario / Login: {{ $dato->login }}<br>                        
                            Email: {{ $dato->email }}  <br>
                            Saldo Actual: <strong>{{ number_format($dato->saldo, 2, ',', '.') }} {{ $idmoneda }}</strong>  
                        </div>
                        <div class="card-footer">
                            

                            @if ($dato->estatus == 'BLO')
                                <button type="button" class="btn btn-sm btn-success" wire:click="desbloquearCaja({{ $dato }});">Desbloquear</button>
                            @else
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="btn btn-sm btn-primary form-control" wire:click="editcaja({{ $dato }});" >Modificar</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-sm btn-danger form-control" wire:click="bloquearCaja({{ $dato }});">Bloquear</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-sm btn-primary form-control" wire:click="recargaSaldoCaja({{ $dato }});" >Recarga</button>
                                    </div>
                                    <div class="col">
                                        @livewire('historicorecargas-controller',['caja'=>$dato], key($dato->id))
                                    </div>
                                    
                                </div>
                                
                                
                                
                                
                                
                                
                            @endif


                            
                            
                        </div>
                    </div>
                </div>
               
            @endforeach
        </div>
            
        <div wire:ignore.self>

            <div class="modal fade" id="modalEditCaja" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="modalEditCajaLabel" aria-hidden="true" wire:ignore.self>

                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalEditCajaLabel">Modificar Caja</h1>
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

                            <div class="row">	
                                <div class="col">
                                    <label for="">Ubicacion de los Videos</label>
                                    <select name="keno_location_video" id="keno_location_video" class="form-control" wire:model.defer="caja.keno_location_video">
                                        <option value="SERVER">SERVIDOR REMOTO</option>
                                        <option value="LOCAL">RUTA LOCAL</option>
                                    </select>

                                    
                                </div>
                            </div>
                    
                            <hr>
                            <h5>Jackpot</h5>
                    
                            <div class="row mt-2">
                    
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">Mini</div>
                                        <div class="card-body">
                                            
                                            
                    
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
                      <button  type="button" class="btn btn-primary" wire:click=GuardarCaja>Modificar</button>
                    </div>
                  </div>
                </div>
              </div>
        
            </div>


            <div class="modal fade" id="modalRecargaSaldo" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-2" aria-labelledby="modalRecargaSaldoLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-sm modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalRecargaSaldoLabel">Recarga de Saldo</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <form action="">             
                            

                            <label for="monto_recarga" class="form-label">Monto recarga <strong>({{ $idmoneda }})</strong></label>

                            <input type="number" class="form-control" id="monto_recarga" wire:model.defer="monto_recarga"/>
                        </form>
                       
                      
                    </div>
                    <div class="modal-footer">                      
                      <button  type="button" class="btn form-control btn-primary" wire:click=procesarRecarga>Recargar</button>
                    </div>
                  </div>
                </div>
              </div>        
            </div>


            
            
        </div>
           

    </div>

<script>

    document.addEventListener('livewire:load', function () {


        Livewire.on('open_modal', (name) => {  
                $("#"+name).modal('toggle'); 
            });

        Livewire.on('close_modal', (name) => {  
                $("#"+name).modal('toggle'); 
            });

        Livewire.on('mensaje', (titulo, mensaje, tipo) => { 
                swal(titulo, mensaje, tipo);
            } );


        

                       
        
    });

</script>



