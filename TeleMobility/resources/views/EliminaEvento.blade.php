@extends('layouts.user')


@section('content')

<div class="container">
    <div class="rettangoloPazienteCartella" style= "border: 1px solid black;">
        <div class="cerchioPaziente" style="border: 1px solid black;">
            <img src="{{ asset('images/' . Auth::user()->Immagine) }}" alt="foto paziente" class="imgCerchioPaziente">
       </div>
       <div  style="padding-top:3%; padding-bottom:3%">
          
           
           <h2 style="text-align: left;padding-left:10px">Visualizza i tuoi eventi </h2>
            
           <h2 style="color:#1A76D1;text-align: left; padding-left:10px">{{Auth::user()->name}} {{Auth::user()->surname}}</h2> 
       </div>
      
   </div>
   @if(session('success'))
   <div class="alert alert-success" style="margin-top: 1%">
       {{ session('success') }}
   </div>
@endif
    
    
      @foreach ($eventiDisturbo as $evento)
    <div class="containerEvento" style="margin-top: 2%">
        <div class="event-infoEvento">
            <h2>Evento Disturbo </h2>
            <p><strong>Disturbo: </strong> {{ ($evento->getDisturboBy_Id($evento->ID_Disturbo))->Nome_Disturbo}}</p> 
            <p><strong>Data: </strong> {{ $evento-> Data_Evento}}</p>
            <p><strong>Orario: </strong> {{ $evento-> Orario}}</p>
            <p><strong>Durata: </strong>{{$evento -> Durata}} Secondi</p>
            <p><strong>Intensità: </strong> {{$evento-> Intensità}}</p>
        </div>
        <form action="{{ route('evento-disturbo.delete', ['id' => $evento->ID]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button id="{{$evento -> ID}}" class="BottoneElEvento" type="submit">Elimina evento</button>
        
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var elemento = document.getElementById('{{ $evento->ID }}');
                    if (elemento) {
                        elemento.addEventListener('click', function(event) {
                            var conferma = confirm('Sei sicuro di voler eliminare questo evento?');
                            if (!conferma) {
                                event.preventDefault();  // Previene l'invio del modulo se l'utente non conferma
                            }
                        });
                    }
                });
            </script>
            
        </form>
    </div>
    @endforeach
    <div class="container">@include('pagination.paginator', ['paginator' => $eventiDisturbo])</div>

       

    <button onclick="window.location.href='{{route('Paziente')}}'" class="bottoneCartella1"> Torna Indietro </button>
</div>

@endsection