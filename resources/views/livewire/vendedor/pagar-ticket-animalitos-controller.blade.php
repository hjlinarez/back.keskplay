                                                                <div>    
    @php 
        $hay_tickets = false;
    @endphp
    @foreach ( $tickets as $ticket)            
        <div id="div_ticket_pagar_'{{ $ticket->idticket }}" class="mb-2">
            @php 
                $pendiente = $ticket->premio - $ticket->pagado;
            @endphp
            @if($pendiente > 0)
                @php 
                $hay_tickets = true;
                @endphp
                <a href="#" onclick="pagarTicket({{ $ticket->idticket }});" class="btn form-control btn-success"><strong>Ticket#:</strong> {{ $ticket->idticket }} - (<strong>Monto:</strong> {{ number_format($pendiente,2,',','.') }})</a>
            @endif
        </div>
    @endforeach

    @if (!$hay_tickets > 0)
        <div class="alert alert-danger text-center">            
            <h4>Disculpe...</h4>
            <h3>No existen tickets para pagar</h3>
        </div>
    @endif   
</div>