@extends('layouts.user')
@section('content')


<div class="container" style="margin-bottom: 150px;margin-top:25px">
   
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>            

        </div>
    @endif
    @if(Auth::user()->role == "Admin") 
    {{ html()->form('POST', route('password.update_admin', $id_clinico ))->acceptsFiles()->open() }}
    
    <div style="padding-top: 1%">
        <h3>Modifica Password Clinico:</h3><br>
    </div>
    <div style="display: flex;">
        <div style="width: 15%; float: left;">
            {{ html()->label('Password Attuale:') }}
        </div>
        <div style="width: 1%;"></div>
        <div>
            {{ html()->password('current_password') }}
        </div>
    </div>
    <div style="display: flex; padding-top: 1%">
        <div style="width: 15%; float: left;">
            {{ html()->label('Password Nuova:') }}
        </div>
        <div style="width: 1%;"></div>
        <div>
            {{ html()->password('password_n') }}
        </div>
    </div>
    <div style="display: flex;padding-top: 1%;">
        <div style="width: 15%; float: left;">
            {{ html()->label('Conferma Password: ') }}
        </div>
        <div style="width: 1%;"></div>
        <div>
            {{ html()->password('password_n_confirmation') }}
        </div>
    </div>

    <div style="padding-top: 3%;">
       <a> <button type="submit" class="bottoneSalva" style="background-color: #1A76D1;color: #ffffff">Salva</button></a>
       {{ html()->form()->close() }}
       <button type="button" onclick="window.location.href='{{route('ClinicoSel', $id_clinico)}}'" class="bottoneSalva" type="button" style="background-color: #1A76D1;color: #ffffff"> Indietro </button>


    </div> 
    @else
    {{ html()->form('POST', route('password.update'))->acceptsFiles()->open() }}
    <div style="padding-top: 1%">
        <h3>Modifica Password </h3><br>
    </div>
    <div style="display: flex;">
        <div style="width: 15%; float: left;">
            {{ html()->label('Password Attuale:') }}
        </div>
        <div style="width: 1%;"></div>
        <div>
            {{ html()->password('current_password') }}
        </div>
    </div>
    <div style="display: flex; padding-top: 1%">
        <div style="width: 15%; float: left;">
            {{ html()->label('Password Nuova:') }}
        </div>
        <div style="width: 1%;"></div>
        <div>
            {{ html()->password('password_n') }}
        </div>
    </div>
    <div style="display: flex;padding-top: 1%;">
        <div style="width: 15%; float: left;">
            {{ html()->label('Conferma Password: ') }}
        </div>
        <div style="width: 1%;"></div>
        <div>
            {{ html()->password('password_n_confirmation') }}
        </div>
    </div>
    

    <div style="padding-top: 3%; width: 30%; display: flex;">
        @can('isPaziente')
       <button onclick="window.location.href='{{route('Gestisci_Account')}}'" class="bottoneSalva" type="button" style="background-color: #1A76D1;color: #ffffff"> Indietro </button>
       @endcan
       
       @can('isClinico')
       
       <button onclick="window.location.href='{{route('Clinico')}}'" class="bottoneSalva" type="button" style="background-color: #1A76D1;color: #ffffff"> Indietro </button>
 
       @endcan
       <a href="{{route('Gestisci_Account') }}"> <button type="submit" class="bottoneSalva" style="background-color: #1A76D1;color: #ffffff; margin-left:1em" >Salva</button></a>
     
       
       
      
       {{ html()->form()->close() }}
    </div>

    @endif
</div>





@endsection




