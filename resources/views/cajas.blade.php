@extends('layouts.template')
@section('container')
    
    <main>
        <div class="container-fluid px-4">          
            @livewire('caja-controller')
            @livewireScripts
        </div>        
    </main>
@endsection
