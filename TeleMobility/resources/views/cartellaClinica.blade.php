@extends('layouts.user')

@section('content')

<!--Immagine Paziente-->
<div class="container">
        <div class="rettangoloPazienteCartella" style= "border: 1px solid black;">
             <div class="cerchioPaziente" style="border: 1px solid black;">
                <img src="{{ asset('images/' . Auth::user()->Immagine) }}" alt="foto paziente" class="imgCerchioPaziente">
            </div>
            <div  style="padding-top:3%; padding-bottom:3%">
                <h2 style="text-align: left;padding-left:10px">Ecco la tua Cartella Clinica</h2>
                <h2 style="color:#1A76D1;text-align: left; padding-left:10px">{{Auth::user()->name}} {{Auth::user()->surname}}</h2> 
            </div>
        </div>


        <!--Inizio Cartella Clinica-->
        <div class="titoloCartella">
            <h3 style="padding-top: 5px; padding-left: 5px">Elenco dei Disturbi</h3>
        </div>
        <div class = "contenutoCartella" style= "margin-top: 0.5em; margin-bottom: 1em; border: 1px solid black;"" >
        @isset($Lista_Disturbi)
        @foreach ($Lista_Disturbi as $Disturbo)
                <div style="margin-top: 0.5em; margin-left: 0.5em">
                    <h4>{{$Disturbo->Nome_Disturbo}}  <a href="{{ route('Descrizione_disturbo',['id' => $Disturbo->Id_Disturbo] )}} "> <span class="arrow mostra-nascondi" style="cursor: pointer;"> ▶️ </span> </a></h4>
                       
                    
                </div>
        @endforeach
        @endisset
        </div>
    
        <div>
            <button onclick="window.location.href='{{ route('Paziente') }}'" class="bottoneCartella1"> Torna indietro</button>
            <button onclick="window.location.href='{{ route('terapiaPaziente') }}'" class="bottoneCartella1"> Consulta Terapia</button>

        </div>
</div>



@endsection
