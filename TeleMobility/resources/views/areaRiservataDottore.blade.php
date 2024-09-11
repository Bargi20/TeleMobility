@extends('layouts.user')

@section('content')

<div class="container">

    <div class="rettangoloPaziente">
            <div class="cerchioPaziente" style = "border: 1px solid black;">
            <img src="{{ asset('images/' . Auth::user()->Immagine) }}" alt="foto clinico" class="imgCerchioPaziente">
            </div>
            <div class="benvenuto">
            @if( Auth::user()-> Genere == 'M')
            <h1>Benvenuto Dr. <br>{{Auth::user()->name}} {{Auth::user()->surname}}</h1>
            @endif
            @if( Auth::user()-> Genere  == 'F')
            <h1>Benvenuta Dottoressa <br>{{Auth::user()->name}} {{Auth::user()->surname}}</h1>
            @endif
            </div>
    </div>
    <div>
        <h3>Scegli cosa fare: </h3>
        <br>
    </div>
    <!--
    <a href="{{ route('Modifica_Password_Clinico') }}">
    <button class="bottone" style="background-color: #1A76D1; color: #ffffff">
    Modifica Password</button></a>
    -->
    <button onclick="window.location.href='{{route('Modifica_Password_Clinico')}}'" class="bottoneCartella1"> Modifica Password </button>

    <button onclick="window.location.href='{{route('ricerca_paziente')}}'" class="bottoneCartella1"> Ricerca Paziente </button>

    <a href="{{route ('registra_paziente')}}">
        <button class="bottone" style="background-color: #1A76D1; color: #ffffff">
            Registra Paziente
        </button>
    </a>
    <a href="{{route ('home_messaggi')}}">
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


