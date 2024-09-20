@extends('layouts.template')
@section('container')
    <main>
        <div class="container-fluid px-4">          
            @livewire('vendedor.show-controller')
            @livewireScripts
        </div>    
    </main>
@endsection