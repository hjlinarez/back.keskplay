<div>
    <h1>Cajas</h1>
      
    <a href="NuevaCaja" class="btn btn-success btn-sm">Nueva Caja </a>
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
                            <button class="btn btn-sm btn-primary">Modificar</button>
                            <button class="btn btn-sm btn-danger">Bloquear</button>
                            <button class="btn btn-sm btn-primary">Parametros</button>
                            <button class="btn btn-sm btn-primary">Recarga de Saldo</button>
                        @endif


                        
                        
                    </div>
                </div>

               
            @endforeach
        
</div>
