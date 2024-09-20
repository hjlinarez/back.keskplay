<div id="" class="container-fluid">
    
        
        <h4>Cambiar Clave</h4>
        
        <form>
            @csrf
            
            <div class="mb-3">
                <label for="password" class="form-label">Clave Actual</label>
                <input type="password" class="form-control" id="password" wire:model.defer="password">
            </div>

            <div class="mb-3">
                <label for="newpassword" class="form-label">Nueva clave</label>
                <input type="password" class="form-control" id="newpassword" wire:model.defer="newpassword">
            </div>

            <div class="mb-3">
                <label for="repitepassword" class="form-label">Repita la clave</label>
                <input type="password" class="form-control" id="repitepassword" wire:model.defer="repitepassword">
            </div>
           
            <div class="text-red">
              {{ $message }}
            </div>

            <button type="button" class="btn btn-primary" wire:click="cambiarPassword" >Cambiar</button>
        </form>


        <script>
          window.addEventListener('message', (e) => {            
                              swal(e.detail.title, e.detail.message, e.detail.type);
                      });
        </script>

</div>
