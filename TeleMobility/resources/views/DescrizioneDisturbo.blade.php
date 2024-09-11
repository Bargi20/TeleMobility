@extends('layouts.user')

@section('content')
<div class="container">
    <div class="rettangoloPazienteCartella" style="border: 1px solid black;">
        
       <div  style="padding-top:3%; padding-bottom:3%;padding-left:1%">
           <h2 style="text-align: left; padding-left:10px">Descrizione disturbo:</h2>
           <h2 style="color:#1A76D1;text-align: left; padding-left:10px">{{$disturbo->Nome_Disturbo}}</h2> 
       </div>
   </div>

   <div class="titoloCartella" >
    <h3 style="padding-top: 5px; padding-left: 10px">Descrizione</h3>
</div>


    <div class = "contenutoCartella" style="color:black; margin-top: 0.5em; margin-bottom:1em; border: 1px solid black;">
        <div style="margin-top: 0.5em; margin-left: 0.5em">
            @if ( $disturbo->Descrizione != null)
            {{$disturbo->Descrizione}}
            @else
            Nessuna descrizione disponibile
            @endif
            
        </div>
    </div>

    @if ( Auth::user()->role == "Paziente" )
    <div class="containerPulsanti">
        <div>
            <a href="{{route('cartellaPaziente')}}">
                <button  class="bottoneCartella1"> Torna indietro</button>
            </a>
        </div>
    </div>
    @endif
    @if( Auth::user()->role == "Admin" )
    <div class="containerPulsanti">
        <div>
            <a href="{{route('DisturbiAdmin')}}">
                <button  class="bottoneCartella1"> Torna indietro</button>
            </a>
        </div>
    </div> 
    @endif
    @if( Auth::user()->role == "Clinico" )
    <div class="containerPulsanti">
        <div>
            <a>
                <button class="bottoneCartella1" onclick="goBack()"> Torna indietro</button>
            </a>
            
        </div>
    </div> 
    @endif

</div>
@endsection
