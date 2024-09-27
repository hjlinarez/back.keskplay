@extends('layouts.template')
@section('container')
    
    <main>
        <div class="container-fluid px-4">          
            @livewire('operador-controller')
            @livewireScripts
        </div>        
    </main>
@endsection
