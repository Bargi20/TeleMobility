@extends('layouts.user')

@section('content')
@if($ruolo == "Clinico")
<div class="container">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>            

        </div>
    @endif
    <br>
    @if(isset($id_risposta))
        
    {{ html()->form('POST', route('messaggi_store_risposta', ['risposta' => $id_risposta]))->acceptsFiles()->open() }}
    @else
    {{ html()->form('POST', route('messaggi_store'))->acceptsFiles()->open() }}
    @endif
    
  
    
    
    <div class="containerInserisci" >
        <div style="padding-top: 1%">
        <h3>Nuovo messaggio </h3><br>
        </div>
    
    <br>
    @if(isset($id_risposta))
     <div style="width: 90%;">
        <h4> Risposta al messaggio inviato da {{$pazienti[$id_paziente]}} </h4>
    </div>
    {{ html()->hidden('id_destinatario', $id_paziente ) }}
    @else
   <div style="width: 40%;">
    <h6 style="color: black;">Seleziona Destinatari: </h6>
    </div>
    
    <div style="height: 10px;"></div>
 
    <div style="max-height: 100px; padding-left:10px; max-width: 40% ; overflow-y: auto; border: 1px solid black">

        @foreach($pazienti as $id => $paziente)
            <div>
                <input type="checkbox" name="id_destinatario[]" value="{{ $id }}" onchange="controlla()"> {{ $paziente }}
            </div>
        @endforeach
        
    </div>
    <div style="max-height: 100px; padding-left:10px;margin-top:5px; max-width: 40% ;">
    <input type="checkbox" name="all"  onchange="seleziona()"> Seleziona tutto
    </div>


    @endif
    </div>

    <div style="padding-top: 35px;">
            <div style="width: 15%; float: left; ">
                <h6 style="color: black;">Titolo Messaggio:</h6>
            </div>

            <div style="width: 70%; padding-top: 30px;">
                <textarea name="corpo" id="current" style="width: 100%; height: 200px; padding: 10px; font-size: 16px; border: 1px solid black"></textarea>
            </div>
            
        </div>
        <div style="padding-top: 35px;">
            <div style="width: 30%; float: left; ">
                <h6 style="color: black;">Contenuto Messaggio :</h6>
            </div>

            <div style="width: 70%; padding-top: 30px;">
                <textarea name="contenuto" id="current" style="width: 100%; height: 200px; padding: 10px; font-size: 16px;border: 1px solid black"></textarea>
            </div>
            
        </div>
    
    
  

    
    <div>
        <button type="submit" class="bottoneCartella1">Salva</button>
        {{ html()->form()->close() }}

    </div>  
    <div style="margin-top:0.5%">
    <button onclick="window.location.href='{{route('home_messaggi')}}'" class="bottoneCartella1"> Indietro </button>
    </div>
</div>
@endif

@if($ruolo == "Paziente" )

    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>            
    
            </div>
        @endif
        <br>
        

        @if(isset($id_risposta))
        
    {{ html()->form('POST', route('messaggi_store_risposta_paziente', ['risposta' => $id_risposta]))->acceptsFiles()->open() }}
    @else
    {{ html()->form('POST', route('messaggi_store_paziente'))->acceptsFiles()->open() }}
    @endif
       
            <div style="padding-top: 1%">
            
    @if(isset($id_risposta))   
    <h3>Nuovo Messaggio di risposta </h3> 
    @else
    <h3>Nuovo messaggio </h3>
    @endif
</div>
        <div style="padding-top: 20px;">
                <div style="width: 15%; float: left; ">
                    <h6 style="color: black;">Titolo Messaggio:</h6>
                </div>
    
                <div style="width: 70%; padding-top: 30px;">
                    <textarea name="corpo" id="current" style="width: 100%; height: 200px; padding: 10px; font-size: 16px;"></textarea>
                </div>
                
            </div>
            <div style="padding-top: 35px;">
                <div style="width: 30%; float: left; ">
                    <h6 style="color: black;">Contenuto Messaggio :</h6>
                </div>
    
                <div style="width: 70%; padding-top: 30px;">
                    <textarea name="contenuto" id="current" style="width: 100%; height: 200px; padding: 10px; font-size: 16px;"></textarea>
                </div>
                
            </div>
        
        
      
    
        
        <div>
            <button type="submit" class="bottoneCartella1">Salva</button>
            {{ html()->form()->close() }}
    
        </div>  
        <div style="margin-top:0.5%">
        <button onclick="window.location.href='{{route('home_messaggi_paziente')}}'" class="bottoneCartella1"> Indietro </button>
        </div>
    </div>

@endif
@endsection






