<div>
    
    <a href="#" class="btn btn-success btn-sm   "  data-bs-toggle="modal" data-bs-target="#newOperador">Nuevo Operador</a>


    <div class="modal fade" id="newOperador" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-2" aria-labelledby="newOperadorLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog  modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="newOperadorLabel">Nuevo Operador</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                
               <form action="">
                    
                    <div class="mb-3">
                        <label for="" class="form-label">Nombre Operador</label>
                        <input type="text"  class="form-control" name="name" id="name" wire:model.defer=operador.name placeholder=""/>                        
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="text"  class="form-control" name="email" id="email"  wire:model.defer=operador.email placeholder=""/>                                                
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Permitir el regigtro de Operadores</label>
                        <select class="form-control" name="suboperadores" id="suboperadores" wire:model=operador.suboperadores>
                            <option value=0>NO</option>
                            <option value=1>SI</option>
                            

                        </select>
                        
                    </div>
                    

                    
                    
               </form>
              
            </div>
            <div class="modal-footer">                      
              
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-success"  wire:click=registrar>Crear</button>
              
            </div>
          </div>
        </div>
      </div>        


</div>
<script>
    $('#newOperador').on('show.bs.modal', function () {
        $('#name').val('');
        $('#email').val('');
        $('#suboperadores').val(0);
    })
</script>