@extends('layouts.user')


@section('content')

<div class="container">

    <div class="rettangoloPaziente">
            <div class="cerchioPaziente" style = "border: 1px solid black;">
                <img src="{{ asset('images/' . Auth::user()->Immagine) }}" alt="foto paziente" class="imgCerchioPaziente">
            </div>
            <div style = " padding-top:15px; font-family: Arial, Helvetica, sans-serif;">
            @if( Auth::user()-> Genere == 'M')
            <h1>Benvenuto <br>{{Auth::user()->name}} {{Auth::user()->surname}}</h1>
            @endif
            @if( Auth::user()-> Genere  == 'F')
            <h1>Benvenuta <br>{{Auth::user()->name}} {{Auth::user()->surname}}</h1>
            @endif
            </div>
    </div>
    <div>
        <h3>Scegli cosa fare: </h3>
        <br>
    </div>
    <a href="{{ route('Gestisci_Account') }}">
    <button class="bottone {{ Request::is('Gestisci_Account') ? 'active' : '' }}" style="background-color: #1A76D1; color: #ffffff">
    Gestisci Account</button></a>

    <a href="{{ route('diagnosi.create') }}">
    <button class="bottone {{ Request::is('Inserisci_Evento') ? 'active' : '' }}" style="background-color: #1A76D1; color: #ffffff">Inserisci Evento</button></a>

    <a href="{{route ('EliminaEvento')}}">
        <button class="bottone" style="background-color: #1A76D1; color: #ffffff">
            Elimina Evento
        </button>
    </a>
<a href="{{route ('cartellaPaziente')  }}">
    <button class="bottone" style="background-color: #1A76D1; color: #ffffff">
        Consulta Cartella Clinica
    </button>
</a>
<a href="{{route ('home_messaggi_paziente')}}">
    <button class="bottone" style="background-color: #1A76D1; color: #ffffff">
         Messaggi
    </button>
</a>

@if(session('success'))
<div class="alert alert-success" style="margin-top: 1%">
    {{ session('success') }}
</div>
@endif
</div>
@endsection

