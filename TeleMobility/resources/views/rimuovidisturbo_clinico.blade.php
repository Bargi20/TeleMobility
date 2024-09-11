@extends('layouts.user')

@section('content')


<div class="container">


    @if($disturbiposseduti)

        <div style="text-align:center; margin-top:60px;margin-bottom:60px">
            <h1>Nessun disturbo eliminabile</h1>
        </div>
        
    @else
    
   <h2>Elenco dei disturbi eliminabili</h2>
    
   @if(session('success'))
   <div class="alert alert-success" style="margin-top: 1%">
       {{ session('success') }}
   </div>
@endif
   
   @foreach ($disturbi as $disturbo => $nome)
        {{ html()->form('POST', route('disturbo.deletePaziente', ['idPaziente' => $idPaziente]) )->acceptsFiles()->open() }}
        <div class="containerEvento" style="margin-top:20px">
                <div class="event-infoEvento"> 
                        <h4> {{$nome}} </h4>
                </div>
                {{ html()->hidden('ID_Disturbo', $disturbo) }}
                {{ html()->button('Rimuovi Disturbo')->type('submit')->name('submitDisturbo_' . $disturbo)->class('submitDisturbo')}}
        </div>
        {{ html()->form()->close() }}
   @endforeach
   @endif
   <a href="{{ route('PazienteSelezionato', $paziente->id)}}"><button class="bottoneCartella1">Indietro</button></a>
   

  
  
</div>

@endsection


