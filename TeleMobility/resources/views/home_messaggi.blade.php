@extends('layouts.user')
@section('content')

@if(Auth::user()-> role == 'Paziente')
<div class="container">

    <div class="rettangoloPaziente">
            <div class="cerchioPaziente" style = "border: 1px solid black;">
            <img src="{{ asset('images/' . Auth::user()->Immagine) }}" alt="foto clinico" class="imgCerchioPaziente">
            </div>
           
            <div class="benvenuto" style="padding-top:7px">
                @if( Auth::user()-> Genere == 'M')
                <h2>Sezione messaggi <br>{{Auth::user()->name}} {{Auth::user()->surname}}</h2>
                @endif
                @if( Auth::user()-> Genere  == 'F')
                <h2>Sezione messaggi  <br>{{Auth::user()->name}} {{Auth::user()->surname}}</h2>
                @endif
                </div> 

           
           
    </div>
    <div>
        <h3>Scegli in che sezione entrare: </h3>
        <br>
    </div>
  
    <a href="{{route ('Paziente')}}">
        <button class="bottone" style="background-color: #1A76D1; color: #ffffff">
             Indietro
        </button>
    </a>
    <button onclick="window.location.href='{{route('visualizza_messaggi_paziente',1)}}'" class="bottoneCartella1"> Messaggi Inviati </button>
    <button onclick="window.location.href='{{route('visualizza_messaggi_paziente',2)}}'" class="bottoneCartella1"> Messaggi Non Letti </button>

    <button onclick="window.location.href='{{route('visualizza_messaggi_paziente',3)}}'" class="bottoneCartella1"> Messaggi Letti </button>

    <a href="{{route ('nuovo_messaggio_paziente')}}">
        <button class="bottone" style="background-color: #1A76D1; color: #ffffff">
            Nuovo Messaggio 
        </button>
    </a>
    

    @if(session('success'))
    <div class="alert alert-success" style="margin-top: 1%">
        {{ session('success') }}
    </div>
    @endif
</div>
@endif

@if(Auth::user()-> role == 'Clinico')
<div class="container">

    <div class="rettangoloPaziente">
            <div class="cerchioPaziente" style = "border: 1px solid black;">
            <img src="{{ asset('images/' . Auth::user()->Immagine) }}" alt="foto clinico" class="imgCerchioPaziente">
            </div>
           
            <div class="benvenuto" style="padding-top:7px">
                @if( Auth::user()-> Genere == 'M')
                <h2>Sezione messaggi <br>Dr. {{Auth::user()->name}} {{Auth::user()->surname}}</h2>
                @endif
                @if( Auth::user()-> Genere  == 'F')
                <h2>Sezione messaggi <br>Dottoressa {{Auth::user()->name}} {{Auth::user()->surname}}</h2>
                @endif
                </div> 
               

           
           
    </div>
    <div>
        <h3>Scegli in che sezione entrare: </h3>
        <br>
    </div>
  
    <a href="{{route ('Clinico')}}">
        <button class="bottone" style="background-color: #1A76D1; color: #ffffff">
             Indietro
        </button>
    </a>
    <button onclick="window.location.href='{{route('visualizza_messaggi',1)}}'" class="bottoneCartella1"> Messaggi Inviati </button>
    <button onclick="window.location.href='{{route('visualizza_messaggi',2)}}'" class="bottoneCartella1"> Messaggi Non Letti </button>

    <button onclick="window.location.href='{{route('visualizza_messaggi',3)}}'" class="bottoneCartella1"> Messaggi Letti </button>

    <a href="{{route ('nuovo_messaggio')}}">
        <button class="bottone" style="background-color: #1A76D1; color: #ffffff">
            Nuovo Messaggio 
        </button>
    </a>
    

    @if(session('success'))
    <div class="alert alert-success" style="margin-top: 1%">
        {{ session('success') }}
    </div>
    @endif
</div>
@endif



@endsection






