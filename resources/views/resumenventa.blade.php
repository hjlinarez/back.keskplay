@extends('layouts.template')
@section('container')
    <main>
        <div class="container-fluid px-4">          
            @livewire('agente.resumenventa-controller')
            @livewireScripts
        </div>    
    </main>
@endsection