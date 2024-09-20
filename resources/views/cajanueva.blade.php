@extends('layouts.template')
@section('container')
    
    <main>
        <div class="container-fluid px-4">          
            @livewire('nuevacaja-controller')
            @livewireScripts
        </div>        
    </main>
@endsection
