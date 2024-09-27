<div>
    <h1>Operadores</h1>
    {{-- The Master doesn't talk, he acts. --}}

    <div class={{ $suboperadores == 1 ? 'visually': 'visually-hidden'}}>
        @livewire('newoperador-controller')    
        <hr>
    </div>

    <input type="text" class="form-control" placeholder="Buscar" wire:model="filtro">
    <select name="" id="" class="form-control mt-1" wire:model="estatus">
        <option value="ALL">Todos</option>
        <option value="ACT">Activos</option>
        <option value="BLO">Bloqueados</option>   
    </select>

    <div class="row">
    @foreach ($data as $dato ) 
        
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <div class="card text-start mt-1">
                    
                    <div class="{{ $dato->estatus == 'BLO' ? 'card-header bg-danger text-white' : 'card-header fw-bold'}}">{{ $dato->name }} {{ $dato->estatus == 'BLO' ? '(Bloqueado)' : ''}} </div>

                    <div class="card-body ">                        
                        
                        Email: {{ $dato->email }}  <br>

                        Saldo Actual: <strong>{{ number_format($dato->saldo, 2, ',', '.') }} {{ $idmoneda }}</strong> <br> 

                        Registro de Operadores: <strong>{{ $dato->suboperadores == 1 ? 'SI': 'NO' }}</strong>  
                        
                    </div>
                    <div class="card-footer">
                        
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn btn-sm btn-primary form-control" wire:click="edit({{ $dato }});" >Modificar</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="{{ $dato->estatus == 'BLO' ? 'visually-hidden' : 'btn btn-sm btn-danger form-control' }}" wire:click="bloquear({{ $dato }});">Bloquear</button>
                                    <button type="button" class="{{ $dato->estatus == 'BLO' ? 'btn btn-sm btn-success form-control' : 'visually-hidden' }}" wire:click="desbloquear({{ $dato }});">Desbloquear</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="{{ $dato->estatus == 'BLO' ? 'visually-hidden' : 'btn btn-sm btn-primary form-control' }}"  wire:click="recargaSaldo({{ $dato }});" >Recarga</button>
                                </div>
                                <div class="col">
                                    @livewire('operadorrecargas-controller', ['operador'=>$dato], key($dato->id))
                                </div>
                            </div>
                        
                    </div>
                </div>

            </div>
       

        
    @endforeach
    </div>

    <div wire:ignore.self>

        <div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true" wire:ignore.self>

            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="modalEditLabel">Modificar</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form action="">
                        <div class="mb-3">
                            <label for="" class="form-label">Nombre Operador</label>
                            <input type="text"  class="form-control" name="name" id="name" wire:model.defer=operador.name />                        
                        </div>
    
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="text"  class="form-control" name="email" id="email"  wire:model.defer=operador.email />                                                
                        </div>
    
                        <div class="mb-3">
                            <label for="" class="form-label">Permitir el registro de Operadores</label>
                            <select class="form-control" name="suboperadores" id="suboperadores" wire:model=operador.suboperadores>
                                <option value=0 {{ $operador["suboperadores"] == 0 ? 'selected' : '' }}>NO</option>
                                <option value=1 {{ $operador["suboperadores"] == 1 ? 'selected' : '' }}>SI</option>                                    
                            </select>
                            
                        </div>
                        
                        
                        
                    </form>                      
                </div>


                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button  type="button" class="btn btn-primary" wire:click=GuardarOperador>Modificar</button>
                </div>
              </div>
            </div>
          </div>
    
        </div>

        <div class="modal fade" id="modalRecargaSaldo" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-2" aria-labelledby="modalRecargaSaldoLabel" aria-hidden="true" >
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
