@extends('layouts.template')
@section('container')
    <main>
        @livewire('user.cambiarpassword-controller') 
        @livewireScripts   
    </main>
@endsection
