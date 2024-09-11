@extends('layouts.user')

@section('content')


<div class="container">


<h1 style="text-align:center; margin-top: 30px;margin-bottom:50px">Elenco dei disturbi:</h1>

        @if (session('success'))
                <div class="alert-success">
                <span class="alert-icon">✔️</span>
                <span class="alert-message">{{ session('success') }}</span>
                
                </div>
         @endif

   @foreach ($disturbi as $disturbo) 
        <div class="containerDisturbiAdmin" >
                <div class="divDisturbo"> 
                        <h4 class="h4Disturbo"> {{$disturbo->Nome_Disturbo}} <a href="{{ route('Descrizione_disturbo',['id' => $disturbo->Id_Disturbo] )}} "> <span class="arrow mostra-nascondi" style="cursor: pointer;"> ▶️ </span> </a></h4>
                </div>
                        

                        <div class= "containerBottoniDisturbi" style="display:flex;padding-top:10px;padding-bottom:10px;flex-direction: column;" >

                        
                        {{ html()->form('DELETE', route('disturbo.destroy', $disturbo->Id_Disturbo))
                                ->attribute('onsubmit', 'return confirm("Sei sicuro di voler eliminare questo disturbo?");')
                                ->open() }}
                                
                                
                        {{ html()->hidden('_token', csrf_token()) }}
                        {{ html()->button('Elimina')->type('submit')->class('bottoneAdminDisturbi')->style('background-color:#e70000;margin-top:5px;')}}
                        {{ html()->form()->close() }}


                        {{ html()->form('GET', route('disturbo.edit', $disturbo->Id_Disturbo))->open() }}

                        {{ html()->hidden('_token', csrf_token()) }}
                        {{ html()->button('Modifica')->type('submit')->class('bottoneAdminDisturbi')->style('color:black;background-color: #f2f2f2;margin-top:5px;') }}

                        {{ html()->form()->close() }}
                        </div>
                        
                
                
        </div>
   @endforeach
   @include('pagination.paginator', ['paginator' => $disturbi])
   <div class= "containerBottoniFaqs"  style="margin-top:70px">

        <button onclick="window.location.href='{{route('Amministratore')}}'" class="bottoneAdminFaq" style="background-color: #1A76D1;border-radius: 0.4em;">Torna Indietro</button>
        <div> <a href="{{route('DisturbiStorePage')}}"><button class="bottoneAdminFaq" style="background-color: #1A76D1;border-radius: 0.4em;">Aggiungi Disturbo</button></a></div>
    </div>
    



</div>



@endsection