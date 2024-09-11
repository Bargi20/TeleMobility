@extends('layouts.user')
@section('content')


@if($paziente)
<div class="container">
    <div class="container2" >
        <div style="background-color: #0000; display: flex ;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Nome:</h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{$paziente->name}} </h6>
            </div>
        </div>


            <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Cognome</h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{$paziente->surname}}</h6>
            </div>
        </div>

        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Data di Nascita:  </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{$paziente->DataDiNascita}} </h6>
            </div>
        </div>


        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Indirizzo: </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{$paziente->Indirizzo}}</h6>
            </div>
        </div>

        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Telefono:</h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{$paziente->Telefono}} </h6>
            </div>
        </div>


        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Email:  </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{$paziente->email}} </h6>
            </div>
        </div>


        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Genere: </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{$paziente->Genere}}</h6>
            </div>
        </div>

        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Disturbi: </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%; border: 1px solid black;" >
                @if(isset($Lista_Disturbi) && count($Lista_Disturbi) > 0)
                @foreach($Lista_Disturbi as $Disturbo)
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{$Disturbo->Nome_Disturbo}}  <a href="{{ route('Descrizione_disturbo',['id' => $Disturbo->Id_Disturbo] )}} "> <span class="arrow mostra-nascondi" style="cursor: pointer;"> -> </span></h6></a>
                @endforeach  
                @else
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">Nessun Disturbo</h6> 
                @endif

               
            </div>
        </div>
        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Terapia Attuale: </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            @if ( $paziente->Terapia == "///" or $paziente->Terapia ==  "")
            
            <div style="width: 30%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">Non Presente</h6>
            </div>
             
            @else
           
            <div style="width: 80%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: left;  color: black;
                padding-left: 1%;padding-top: 1%; padding-bottom: 1% ;padding-right: 1%;font-size: 15px;">{!! nl2br(e($paziente->Terapia)) !!}</h6>
            </div>
    
            @endif 
            
            
        </div>

        </div>

    
     <a href="{{route('ricerca_paziente')}}">
    <button class="bottoneCartella1">Torna indietro</button>
    </a>
    <a href="{{ route('aggiungi_disturbo', $paziente->id) }}">  
    <button class="bottone" style="background-color: #1A76D1; color: #ffffff">
    Inserisci Disturbo</button></a>

    <a href="{{ route('rimuovi_disturbo', $paziente->id) }}">
        <button class="bottone" style="background-color: #1A76D1; color: #ffffff">
        Elimina Disturbo</button></a>
    
        <a href="{{ route('ModificaTerapia', $paziente->id) }}">
    <button class="bottone" style="background-color: #1A76D1; color: #ffffff">
    Modifica Terapia</button></a>

    <a href="{{ route('EliminaEventoClinico', $paziente->id) }}">
        <button class="bottone " style="background-color: #1A76D1; color: #ffffff">
        Visualizza Eventi</button></a> 
     
      


    @if(session('success'))
    <div class="alert alert-success" style="margin-top: 1%">
        {{ session('success') }}
    </div>
@endif

</div>
@else
    <p>Il paziente non è stato trovato.</p>
@endif








@endsection
