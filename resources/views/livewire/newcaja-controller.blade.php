<div>
    
    <a href="#" class="btn btn-success btn-sm   "  data-bs-toggle="modal" data-bs-target="#newCaja">Nueva Caja</a>


    <div class="modal fade" id="newCaja" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-2" aria-labelledby="newCajaLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg   modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="newCajaLabel">Nueva Caja</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                

                <form action="">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" required wire:model="caja.name" placeholder="Indique el nombre de la Caja"/>
                        </div>
            
                        <div class="col-md-4">
                            <label for="name" class="form-label">Correo Electronico</label>
                            <input type="email" class="form-control" id="email" required wire:model="caja.email" placeholder="abc@mail.com"/>
                        </div>

                        <div class="col-md-4">
                            <label for="idpais" class="form-label">Pais</label>
                            <select name="idpais" id="idpais" class="form-control" required wire:model="caja.idpais">
                                <option value="">Seleccione el Pais</option>
                                @foreach ($paises as $pais )
                                    <option value="{{ $pais->idpais}}">{{ $pais->pais}}</option>
                                @endforeach
                            </select>
                            
                        </div>


                    </div>
            
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="login" required wire:model="caja.login"/>
                        </div>
            
                        <div class="col-md-4">
                            <label for="name" class="form-label">Clave</label>
                            <input type="password" class="form-control" id="password" required wire:model="caja.password"/>
                        </div>
            
                        <div class="col-md-4">
                            <label for="name" class="form-label">Repita la Clave</label>
                            <input type="password" class="form-control" id="repeat_password" required />
                        </div>
                    </div>
                    <div class="class">
                        <div class="col">
                            <label for="" class="form-label">Moneda</label>
                            <select name="idmoneda" id="idmoneda" class="form-control" wire:model.defer=caja.idmoneda>
                            <option wire:key="moneda-0" value="">Seleccione la Moneda</option>
                            @foreach ($monedas as $moneda)
                                <option wire:key="moneda-{{ $moneda->idmoneda }}" value="{{ $moneda->idmoneda }}">
                                    {{ $moneda->moneda }}
                                </option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <hr>
                    <h5>Config Keno</h5>
            
                    <div class="row">
                        <div class="col">
                            <label for="apuesta_minima" class="form-label">Apuesta Minima</label>
                            <input type="number" class="form-control" id="apuesta_minima" wire:model="caja.apuesta_minima" placeholder=""/>
                        </div>
            
                        <div class="col">
                            <label for="apuesta_maxima" class="form-label">Apuesta Maxima</label>
                            <input type="number" class="form-control" id="apuesta_maxima" wire:model="caja.apuesta_maxima"/>
                        </div>
            
                        <div class="col">
                            <label for="apuesta_maxima" class="form-label">Opciones de Pago</label>
                            <input type="text" class="form-control" id="pagos" wire:model="caja.pagos" placeholder="Ej: 100,200,300"/>
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
                                    <input type="number" class="form-control" id="acumulado_mini_jackpot" wire:model="caja.acumulado_mini_jackpot"/>
            
                                    <label for="porc_mini_jackpot" class="form-label">% Recoleccion</label>
                                    <input type="number" class="form-control" id="porc_mini_jackpot" wire:model="caja.porc_mini_jackpot"/>
            
                                    <label for="limite_mini_jackpot" class="form-label">Lim. Entrega</label>
                                    <input type="number" class="form-control" id="limite_mini_jackpot" wire:model="caja.limite_mini_jackpot"/>
            
                                    <label for="porc_entrega_mini_jackpot" class="form-label">% Entrega</label>
                                    <input type="number" class="form-control" id="porc_entrega_mini_jackpot" wire:model="caja.porc_entrega_mini_jackpot"/>
                                    
                                </div>
                            </div>
                        </div>
            
                        <div class="col">
                            <div class="card">
                                <div class="card-header">Super</div>
                                <div class="card-body">
                                    <label for="acumulado_super_jackpot " class="form-label">Monto Inicial</label>
                                    <input type="number" class="form-control" id="acumulado_super_jackpot" wire:model="caja.acumulado_super_jackpot"/>
            
                                    <label for="porc_super_jackpot" class="form-label">% Recoleccion</label>
                                    <input type="number" class="form-control" id="porc_super_jackpot" wire:model="caja.porc_super_jackpot" />
            
                                    <label for="limite_super_jackpot" class="form-label">Lim. Entrega</label>
                                    <input type="number" class="form-control" id="limite_super_jackpot" wire:model="caja.limite_super_jackpot" />
            
                                    <label for="porc_entrega_super_jackpot" class="form-label">% Entrega</label>
                                    <input type="number" class="form-control" id="porc_entrega_super_jackpot" wire:model="caja.porc_entrega_super_jackpot" />
                                </div>
                            </div>
                        </div>
            
                        <div class="col">
                            <div class="card">
                                <div class="card-header">Mega</div>
                                <div class="card-body">
                                    <label for="acumulado_mega_jackpot " class="form-label">Monto Inicial</label>
                                    <input type="number" class="form-control" id="acumulado_mega_jackpot" wire:model="caja.acumulado_mega_jackpot"/>
            
                                    <label for="porc_mega_jackpot" class="form-label">% Recoleccion</label>
                                    <input type="number" class="form-control" id="porc_mega_jackpot" wire:model="caja.porc_mega_jackpot"/>
            
                                    <label for="limite_mega_jackpot" class="form-label">Lim. Entrega</label>
                                    <input type="number" class="form-control" id="limite_mega_jackpot" wire:model="caja.limite_mega_jackpot"/>
            
                                    <label for="porc_entrega_mega_jackpot" class="form-label">% Entrega</label>
                                    <input type="number" class="form-control" id="porc_entrega_mega_jackpot" wire:model="caja.porc_entrega_mega_jackpot"/>
                                </div>
                            </div>
                        </div>
            
                    </div>
                    
                    
                    
                    
                </form>
               
              
            </div>
            <div class="modal-footer">                      
              
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-success"  wire:click=Registrar>Crear</button>
              
            </div>
          </div>
        </div>
      </div>        


</div>
<script>
    $('#newCaja').on('show.bs.modal', function () {
        $('#name').val('');
        $('#email').val('');
        $('#suboperadores').val(0);
    })
</script>