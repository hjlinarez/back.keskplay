<div>
    <h2>Nueva Cajas</h2>
    <form action="">
        <div class="row">
            <div class="col-md-6">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" required wire:model="name" placeholder="Indique el nombre de la Caja"/>
            </div>

            <div class="col-md-6">
                <label for="name" class="form-label">Correo Electronico</label>
                <input type="email" class="form-control" id="email" required wire:model="email" placeholder="abc@mail.com"/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="name" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="login" required wire:model="login"/>
            </div>

            <div class="col-md-4">
                <label for="name" class="form-label">Clave</label>
                <input type="password" class="form-control" id="password" required wire:model="password"/>
            </div>

            <div class="col-md-4">
                <label for="name" class="form-label">Repita la Clave</label>
                <input type="password" class="form-control" id="repeat_password" required wire:model="repeat_password"/>
            </div>
        </div>
        <hr>
        <h5>Config Keno</h5>

        <div class="row">
            <div class="col">
                <label for="apuesta_minima" class="form-label">Apuesta Minima</label>
                <input type="number" class="form-control" id="apuesta_minima" wire:model="apuesta_minima" placeholder=""/>
            </div>

            <div class="col">
                <label for="apuesta_maxima" class="form-label">Apuesta Maxima</label>
                <input type="number" class="form-control" id="apuesta_maxima" wire:model="apuesta_maxima"/>
            </div>

            <div class="col">
                <label for="apuesta_maxima" class="form-label">Opciones de Pago</label>
                <input type="text" class="form-control" id="pagos" wire:model="pagos" placeholder="Ej: 100,200,300"/>
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
                        <input type="number" class="form-control" id="acumulado_mini_jackpot" wire:model="acumulado_mini_jackpot"/>

                        <label for="porc_mini_jackpot" class="form-label">% Recoleccion</label>
                        <input type="number" class="form-control" id="porc_mini_jackpot" wire:model="porc_mini_jackpot"/>

                        <label for="limite_mini_jackpot" class="form-label">Lim. Entrega</label>
                        <input type="number" class="form-control" id="limite_mini_jackpot" wire:model="limite_mini_jackpot"/>

                        <label for="porc_entrega_mini_jackpot" class="form-label">% Entrega</label>
                        <input type="number" class="form-control" id="porc_entrega_mini_jackpot" wire:model="porc_entrega_mini_jackpot"/>
                        
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">Super</div>
                    <div class="card-body">
                        <label for="acumulado_super_jackpot " class="form-label">Monto Inicial</label>
                        <input type="number" class="form-control" id="acumulado_super_jackpot" wire:model="acumulado_super_jackpot"/>

                        <label for="porc_super_jackpot" class="form-label">% Recoleccion</label>
                        <input type="number" class="form-control" id="porc_super_jackpot" wire:model="porc_super_jackpot" />

                        <label for="limite_super_jackpot" class="form-label">Lim. Entrega</label>
                        <input type="number" class="form-control" id="limite_super_jackpot" wire:model="limite_super_jackpot" />

                        <label for="porc_entrega_super_jackpot" class="form-label">% Entrega</label>
                        <input type="number" class="form-control" id="porc_entrega_super_jackpot" wire:model="porc_entrega_super_jackpot" />
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">Mega</div>
                    <div class="card-body">
                        <label for="acumulado_mega_jackpot " class="form-label">Monto Inicial</label>
                        <input type="number" class="form-control" id="acumulado_mega_jackpot" wire:model="acumulado_mega_jackpot"/>

                        <label for="porc_mega_jackpot" class="form-label">% Recoleccion</label>
                        <input type="number" class="form-control" id="porc_mega_jackpot" wire:model="porc_mega_jackpot"/>

                        <label for="limite_mega_jackpot" class="form-label">Lim. Entrega</label>
                        <input type="number" class="form-control" id="limite_mega_jackpot" wire:model="limite_mega_jackpot"/>

                        <label for="porc_entrega_mega_jackpot" class="form-label">% Entrega</label>
                        <input type="number" class="form-control" id="porc_entrega_mega_jackpot" wire:model="porc_entrega_mega_jackpot"/>
                    </div>
                </div>
            </div>

        </div>
        <hr>
        <div class="{{ $mensaje == null ? 'visually-hidden' : 'alert alert-danger text-center'}}" >
            <span class="fw-bold">Error: </span>{{ $mensaje }}
        </div>
        <button type="button" class="btn btn-success btn-lg form-control" wire:click="CrearCaja">Crear Caja</button>
        
    </form>
</div>

<script>

    document.addEventListener('livewire:load', function () {
        Livewire.on('mensaje', (titulo, mensaje, tipo) => { swal(titulo, mensaje, tipo);});
    });

</script>




