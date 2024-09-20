<div>
    <form id="form_pago_ticket" action="">

        <p class="m-0 p-0">
            <span class="fw-bold">Ticket#: </span>
            <span>{{ $idticket }}</span>
        </p>

        <p class="m-0 p-0">
            <span class="fw-bold">Premio Total: </span>
            <span>{{ number_format($premio, 2, ',', '.') }}</span>
        </p>

        <p class="m-0 p-0">
            <span class="fw-bold">Pagado: </span>
            <span>{{ number_format($pagado, 2, ',', '.') }}</span>
        </p>

        <p class="m-0 p-0">
            <span class="fw-bold">Pendiente: </span>
            <span>{{ number_format($pendiente, 2, ',', '.') }}</span>
        </p>
        <hr>        
        @if($pendiente > 0)
            
            <label for="premio">Monto a pagar</label>
            <input type="text" wire:model="monto_pagar" class="form-control">
            <p class="m-0 p-0 fst-italic text-danger">
                @if( $monto_pagar <> '')
                    {{  $monto_valido == 0 ? 'Monto no es valido' : '' }}
                @endif
            </p>
            <label for="serial">Serial</label>
            <input type="text" wire:model="input_serial" class="form-control">
            <p class="m-0 p-0 fst-italic text-danger">            
                @if($input_serial <> '')
                    {{ $serial_valido == 0 ? 'Serial no es valido' : '' }}
                @endif
            </p>
            <br>
            <button type="button"  class="btn {{ $activar_btn_pago == 0 ? 'btn-default' : 'btn-success'}}  form-control" onclick="procesarpagarTicket()" {{ $activar_btn_pago == 0 ? 'Disabled' : ''}}>Pagar</button>
        @else
            <div class="alert alert-danger text-center">Ticket ya fue pagado en su totalidad</div>
        @endif


    </form>
</div>

<script>
    function inicializarPagar(idticket) {
        //alert(idticket);
        @this.UpdateIdticket(idticket);
    }

    function procesarpagarTicket()
    {
        
        @this.pagarTicket().then( (result)=>{
            if (result)
            {
                @this.emit('ActualizarlistaTicketPagar');                
                $("#ModalPagoTicket").modal('hide');                
                swal("Exito","El ticket fue pagado satisfactoriamente", "success");                
            }
            else 
            {
                swal("Lo siento!","El ticket no pudo ser procesado.", "error");
            }
        });

    }

</script>
