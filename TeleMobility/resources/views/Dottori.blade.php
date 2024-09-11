@extends('layouts.user')

@section('content')
@isset($lista)
@foreach ($lista as $dottore)
<div id="content">
   <!--vado a scandire l'array associando ad ogni array un oggetto di oggetto 'product'-->
      <div class="container" style="padding-top: 10px;">
        <div style="background-color: #1A76D1; display: flex; align-items: center ; border-radius: 0.7em;" >
        <!-- Colonna sinistra per l'immagine del dottore -->
        <div  style="padding-left: 20px">
            <div class="cerchioImmagine1">
                <img src="{{ asset('images/' .$dottore->Immagine) }}" alt="foto clinico" class="imgCerchioPaziente">
            </div>
        </div>
        <!-- Colonna destra per il nome del dottore -->
        <div, style="padding-left: 40px">
            @if( $dottore -> Genere == 'M')
            <h1 class="doctor-title">Dr. {{$dottore->name}} {{$dottore->surname}}</h1>
            @endif
            @if( $dottore -> Genere == 'F')
            <h1 class="doctor-title">Dr.essa {{$dottore->name}} {{$dottore->surname}}</h1>
            @endif
        </div>
    </div>
</div>

<div class="container">
    <div style="background-color: #0000; display: flex; align-items: center ;" >

        <div class="col-lg-6-adattato2">
            <h2 class="doctor-title" style="text-align: left; color: black;
			padding-left: 3%; width: max-content;"
			>{{$dottore -> Ruolo_Clinico }} specializzato in {{$dottore -> Specializzazione }}</h2>
			</div>
    </div>

    <div class="container2" >
        <div style="background-color: #0000; display: flex ;" >

            <div style="width: 70%; float: left;" >
                <h6 class="doctor-title" style="text-align: left; padding-bottom: 2%; color: black;
                padding-left: 4%;">{{ $dottore -> Descrizione }}</h6>
                </div>

                <div style=" align-self: flex-end; padding-left: 2%; width: 30%;" >
                    <div class = "rettangoloDottore1">

                        <h6 style="color: white;padding-left: 15px;padding-top: 15px;">Contatti:</h6>

                        <h7 style="color: white;padding-left: 15px;padding-top: 8px;"> Numero di telefono: </h7>
                        <h8 style="color: white;padding-left: 30px;">{{ $dottore ->Telefono }}</h8><br>
                         <h7 style="color: white;padding-left: 15px; padding-top: 8px;">Indirizzo Email:</h7>
                    <h8 style="color: white;padding-left: 30px;">{{ $dottore ->email }}</h8><br><h6></h6><br>
                    </div>
                </div>
        </div>
    </div>
</div>
</div>
@endforeach
@endisset()
@endsection


