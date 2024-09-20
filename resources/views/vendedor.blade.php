@extends('layouts.template')
@section('container')
    <main>
        <div class="container-fluid">
            @livewire('vendedor.loteria-controller', ['idvendedor' => $idvendedor])
            @livewireScripts
        </div>
    </main>
@endsection
