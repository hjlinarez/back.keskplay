@extends('layouts.template')
@section('container')
    <main>        
        <div class="container-fluid px-4">          
            @livewire('home-controller')
            @livewireScripts
        </div>              
    </main>

    
@endsection




