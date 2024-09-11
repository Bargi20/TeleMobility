@extends('layouts.user')
@section('content')

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
                padding-left: 4%;">{{Auth::user()->name}} </h6>
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
                padding-left: 4%;">{{Auth::user()->surname}}</h6>
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
                padding-left: 4%;">{{Auth::user()->DataDiNascita}} </h6>
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
                padding-left: 4%;">{{Auth::user()->Indirizzo}}</h6>
            </div>
        </div>

        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Telefono: </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{Auth::user()->Telefono}} </h6>
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
                padding-left: 4%;">{{Auth::user()->email}} </h6>
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
                padding-left: 4%;">{{Auth::user()->Genere}}</h6>
            </div>
        </div>


        </div>

     <a href="{{route('Paziente')}}">
    <button  class="bottoneCartella1"> Torna indietro</button></a>
    <a href="{{ route('Modifica_Password_Paziente') }}">
    <button class="bottone {{ Request::is('Modifica_Password_Paziente') ? 'active' : '' }}" style="background-color: #1A76D1; color: #ffffff">
    Modifica Password</button></a>


    
    <a href="{{ route('Modifica_Dati') }}">
    <button class="bottone {{ Request::is('Gestisci_Account') ? 'active' : '' }}" style="background-color: #1A76D1; color: #ffffff">
    Modifica Dati</button></a>

    
           
      


    @if(session('success'))
    <div class="alert alert-success" style="margin-top: 1%">
        {{ session('success') }}
    </div>
@endif
</div>

</div>




@endsection
