<div >
    
    <button type="button" class="btn btn-sm btn-primary form-control" wire:click="historicoRecargas({{ $idopera }})">Hist. Recargas</button>

    <div class="modal fade" id="modalHistoricoRecargas{{ $idopera }}" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-2" aria-labelledby="modalHistoricoRecargasLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="modalHistoricoRecargasLabel">Historico de Recargas <strong>({{ $operadorName }})</strong></h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="col">
                        <label for="desde">Desde</label>
                        <input type="date" name="desde" id="desde" class="form-control" wire:model="desde">
                    </div>
                    <div class="col">
                        <label for="hasta">Hasta</label>
                        <input type="date" id="hasta" class="form-control" wire:model="hasta">
                    </div>
                </div>
                <div style="height:18em; overflow:auto">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Fecha / Hora</th>
                                <th class="text-end">Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datos as $dato)
                                <tr>
                                    <td class="text-center">{{ $dato->created_at}}</td>
                                    <td class="text-end">{{ number_format($dato->monto,2,',','.')}}</td>
                                </tr>                                
                            @endforeach
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
               
              
            </div>
            <div class="modal-footer">                      
              
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              
            </div>
          </div>
        </div>
      </div>        
    



</div>
