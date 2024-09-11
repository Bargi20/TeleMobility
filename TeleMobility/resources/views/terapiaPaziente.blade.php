@extends('layouts.user')

@section('content')
<div class="container">
    <div class="rettangoloPazienteCartella" style="border: 1px solid black;">
        <div class="cerchioPaziente" style="border: 1px solid black;">
            <img src="{{ asset('images/' . Auth::user()->Immagine) }}" alt="foto paziente" class="imgCerchioPaziente">
       </div>
       <div  style="padding-top:3%; padding-bottom:3%">
           <h2 style="text-align: left; padding-left:10px">Ecco la tua Terapia</h2>
           <h2 style="color:#1A76D1;text-align: left; padding-left:10px">{{Auth::user()->name}} {{Auth::user()->surname}}</h2> 
       </div>
   </div>

   <div class="titoloCartella" >
    <h3 style="padding-top: 5px; padding-left: 10px">Terapia</h3>
</div>


    <div class = "contenutoCartella" style="color:black; margin-top: 0.5em; margin-bottom:1em; border: 1px solid black;">
        <div style="margin-top: 0.5em; margin-left: 0.5em">
            @if ( Auth::user()->Terapia != null)
            {!! nl2br(e(Auth::user()->Terapia)) !!}
            @else
            Nessuna terapia disponibile
            @endif
        
        </div>
    </div>


    <div class="containerPulsanti">
        <div>
            <button class="bottoneCartella1" onclick="window.location.href='{{ route('cartellaPaziente') }}'">Torna indietro</button>

        </div>
    </div>

</div>
@endsection
