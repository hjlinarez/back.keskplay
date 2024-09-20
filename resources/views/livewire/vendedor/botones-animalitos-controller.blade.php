<div>
    <button type="button" class="btn btn-sm btn-outline-primary m-1" data-bs-toggle="modal" data-bs-target="#ModalConsulta" >Consultar </button>
    <button type="button" class="btn btn-sm btn-outline-primary m-1" data-bs-toggle="modal" data-bs-target="#ModalAnularTicket">Anular <span class="badge bg-primary">{{ $anular }}</span></button>
    <button type="button" class="btn btn-sm btn-outline-primary m-1" data-bs-toggle="modal" data-bs-target="#ModalPagarTicket">Pagar <span class="badge bg-primary">{{ $pagar }}</span></button>                    
    <button type="button" class="btn btn-sm btn-outline-primary m-1" data-bs-toggle="modal" data-bs-target="#ModalVentasLive">Ventas</button>
    <button type="button" class="btn btn-sm btn-outline-primary m-1" data-bs-toggle="modal" data-bs-target="#ModalResultados">Resultados</button>                                    
    <button type="button" class="btn btn-sm btn-outline-primary m-1" data-bs-toggle="modal" data-bs-target="#ModalConfiguracion">Config</button>               
</div>

<script>
    setInterval(() => {
        @this.emit('ActualizarBotones');        
    }, 10000);
</script>
