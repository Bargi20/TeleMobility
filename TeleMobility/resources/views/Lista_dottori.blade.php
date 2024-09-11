@extends('layouts.user')

@section('content')
<!--Start Container Dottore 1-->
@isset($lista)
@foreach ($lista as $dottore)
<div class="container">
    <a href="{{ route('singolo_dottore',intval($dottore->id)) }}">
                <div class="rettangoloDottore">
                    <div class="col-lg-3">
                        <div class="cerchioImmagine">
                           <!-- <img src="images/notfound.png" alt="Foto di un dottore" class="immagine"> -->
                           <img src="{{ asset('images/' .$dottore->Immagine) }}" alt="foto clinico" class="imgCerchioPaziente">

                            </div>
                    </div>
                    <div>
                        @if( $dottore -> Genere == 'M')
                        <h1 class="doctor-title" style="text-align: left; padding-top: 50px">Dottor {{$dottore->name}} {{$dottore->surname}}</h1>
                        @endif
                        @if( $dottore -> Genere == 'F')
                        <h1 class="doctor-title" style="text-align: left; padding-top: 50px">Dottoressa {{$dottore->name}} {{$dottore->surname}}</h1>
                        @endif
                        <h3 class= "doctor-title" style="text-align: left;padding-top : 5px">{{$dottore -> Ruolo_Clinico }} specializzato in {{$dottore -> Specializzazione }}</h3>
                </div>
            </div>
        </a>
        </div>
    </div>
</div>

@endforeach

 <!--Paginazione-->
 <div class="container">@include('pagination.paginator', ['paginator' => $lista])</div>


@endisset()
@endsection

