<div>   
    @if (count($tickets) > 0)
        @foreach ( $tickets as $ticket)            
            <div id="div_ticket_anular_'{{ $ticket->idticket }}" class="alert alert-primary">
                <div class="row">
                    <div class="col text-center">
                        <p class="m-0 p-0"><strong>Ticket#:</strong> {{ $ticket->idticket }}</p>
                    </div>
                    <div class="col text-center">
                        <strong>Monto:</strong> {{ $ticket->monto }}</p>
                    </div>
                    <div class="col text-center">
                        <a href="#" wire:click="anularTicket({{ $ticket->idticket }})" class="btn btn-sm btn-danger">Anular</a>
                    </div>                    
                </div>
            </div>
        @endforeach
    @else        
        <div class="alert alert-danger text-center">            
            <h4>Disculpe...</h4>
            <h3>No existen tickets para anular</h3>
            
        </div>
    @endif      
</div>