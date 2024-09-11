@extends('layouts.user')

@section('content')

<div class="container">
    <h3 style="margin-bottom: 40px">Scegli cosa fare: </h3>


    <button onclick="window.location.href='{{route('GestioneClinico')}}'" class="bottoneAdmin"> Gestione Clinico</button>

    <button onclick="window.location.href='{{route('DisturbiAdmin')}}'" class="bottoneAdmin"> Gestione Disturbi</button>

    <button onclick="window.location.href='{{route('FaqAdmin')}}'" class="bottoneAdmin"> Modifica Faq</button>

    <button onclick="window.location.href='{{route('StatisticheAdmin')}}'" class="bottoneAdmin"> Statistiche Dati</button>
    
    <button onclick="window.location.href='{{route('AttivitaAdmin')}}'" class="bottoneAdmin"> Gestisci Attività </button>
    <button onclick="window.location.href='{{route('FarmaciAdmin')}}'" class="bottoneAdmin"> Gestisci Farmaci </button>
    
</div>
@endsection