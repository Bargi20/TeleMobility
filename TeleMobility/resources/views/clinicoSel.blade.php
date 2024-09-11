@extends('layouts.user')
@section('content')

<div class="container" style="margin-top: 20px; ">
    <div style="display: flex;">
    @isset($lista)
        

    <div class="container2" style="width: 75%;">
        
        <div style="background-color: #0000; display: flex;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Nome:</h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 50%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{$lista->name}} </h6>
            </div>
        </div>


            <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Cognome</h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 50%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{$lista->surname}}</h6>
            </div>
        </div>

        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Data di Nascita:  </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 50%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{$lista->DataDiNascita}} </h6>
            </div>
        </div>
        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Specializzazione:  </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 50%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{$lista->Specializzazione}} </h6>
            </div>
        </div>

        

        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Telefono: </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 50%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{$lista->Telefono}} </h6>
            </div>
        </div>


        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Email:  </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 50%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{$lista->email}} </h6>
            </div>
        </div>


        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Genere: </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 50%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{$lista->Genere}}</h6>
            </div>
        </div>

        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Ruolo: </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 50%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{$lista->Ruolo_Clinico}}</h6>
            </div>
        </div>
        
        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Username: </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            @if ( $lista->username == null)
            
            <div style="width: 50%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">Non Presente</h6>
            </div>
             
            @else
            <div style="width: 50%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: center;  color: black;
                padding-left: 4%;">{{$lista->username}}</h6>
            </div>
    
            @endif 
            
            
        </div>
        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Descrizione: </h6>
            </div>
            <div style="width: 5%;" >
            </div>
        
            
            <div style="width: 50%; border: 1px solid black;" >
                <h6 class="doctor-title" style="text-align: left;  color: black;
                padding-left: 1%;padding-top: 1%; padding-bottom: 1% ;padding-right: 1%;font-size: 15px;">{{$lista->Descrizione}}</h6>
            </div>
        </div> 
        
        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Numero Pazienti: </h6>
            </div>
            <div style="width: 5%;" >
            </div>
                    <div style="width: 50%; border: 1px solid black;">
                <h6 class="doctor-title" style="text-align: center; color: black; padding-left: 4%;">{{count($pazienti)}}</h6>
                </div>
        </div> 
            
            
    <div style="padding-top: 50px"></div>
        <a href="{{route('GestioneClinico')}}">
            <button class="bottoneCartella1">Torna indietro</button>
            </a>
            <a href="{{ route('Modifica_Admin_Clinico_admin', $lista->id) }}">  
            <button class="bottone" style="background-color: #1A76D1; color: #ffffff">
            Modifica Dati Anagrafici</button></a>
        
            <a href="{{ route('Modifica_Password_Clinico_admin', $lista->id) }}">
                    <button class="bottone " style="background-color: #1A76D1; color: #ffffff">
                    Modifica Password</button>
                </a>

                <div style=" margin-top:10px">
                <form action="{{ route('delete_clinico', $lista->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="EliminaClinico" onclick="return confirm('Sei sicuro di voler eliminare questo Clinico?')">Elimina</button>
                </form>
                </div>
               

        </div>
        @endisset
        @isset($pazienti)
        <div style="width: 25%; border-left: 1px solid black; padding-left: 15px;">
            <h4>Lista pazienti dottore:</h4>
            <div style="padding-top: 20px;"></div>
            
            @foreach ($pazienti as $p)
            <div class="paziente-container" style="margin-bottom: 10px;">
                <span>{{$p->name}} {{$p->surname}}</span>
                <form method="POST" action="{{ route('delete_paziente', $p->id) }}">
                    @csrf
                    @method('POST')
                    <button type="submit" class="listaPazientiBottone" onclick="return confirm('Sei sicuro di voler eliminare questo paziente?')">Elimina</button>
                </form>
            </div>
            @endforeach
            

            
          
        </div> 
        @endisset
        
        
    </div>

    @if(session('success'))
    <div class="alert alert-success" style="margin-top: 1%">
        {{ session('success') }}
    </div>
@endif

</div>


















       
    
</div>


@endsection