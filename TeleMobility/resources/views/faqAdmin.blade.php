@extends('layouts.user')

@section('content')
@isset($faq)

<!-- Inizio Faq-->

	<div class="containerFaqCentrato;">
            <h1 style="text-align:center; margin-top: 30px;margin-bottom:30px">Ecco le Faq pubblicate:</h1>

            @if(session('success'))
            <div class="alert alert-success" style="margin-top: 1%; margin-right:130px; margin-left:130px">
                {{ session('success') }}
            </div>
        @endif

			@foreach ($faq as $elemento)
                <div class="containerFaqSingoleNew" style="padding-top: 15px;">
                    <div style="color: white;">
                        <div class="domandaFaqAdmin">
                            <div class="rettangoloFaqNew">
                                <h1  style="display: inline-block;color: white; font-size:x-large;padding-top: 8px; padding-bottom: 8px;
                                padding-left:10px;padding-right:10px" > 
                                {{$elemento -> Domanda }} </h1>
                            </div>
                        </div>
                <!--Start Answer-->
                        <div class="RispostaFaqAdmin">
                            <p style="color:#2c2c2c">{{$elemento -> Risposta }}</p>


                <!--Start Form Bottoni Elimina e Modifica Faq-->
                
                
                                <!--Questo crea un form HTML con il metodo DELETE e l'azione che punta alla rotta 
                                faq.destroy con l'ID della FAQ corrente ($faq->id).-->
                                <!--L'attributo onsubmit viene aggiunto per mostrare una finestra di conferma quando l'utente tenta di inviare il form. 
                                Se l'utente clicca "OK", il form viene inviato; se clicca "Annulla", l'invio del form viene annullato.-->
                                <div class= "containerBottoniFaqs">
                                {{ html()->form('DELETE', route('faq.destroy', $elemento->Id_Faq))
                                    ->attribute('onsubmit', 'return confirm("Sei sicuro di voler eliminare questa FAQ?");')
                                    ->open() }}

                                    <!-- Questo aggiunge un campo nascosto al form per il token CSRF. Laravel utilizza i token CSRF per prevenire attacchi CSRF.
                                csrf_token() genera il token CSRF attuale.-->
                                {{ html()->hidden('_token', csrf_token()) }}
                                {{ html()->button('Elimina FAQ')->type('submit')->class('bottoneAdminFaq')->style('background-color:#ff5200;')}}
                                {{ html()->form()->close() }}


                                <!--Uso due form una di tipo delete per cancellare e una di tipo get per modificare la FAQ-->
                                {{ html()->form('GET', route('faq.edit', $elemento->Id_Faq))->open() }}

                                {{ html()->hidden('_token', csrf_token()) }}
                                {{ html()->button('Modifica FAQ')->type('submit')->class('bottoneAdminFaq')->style('background-color: #1A76D1;') }}

                                {{ html()->form()->close() }}

                                </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class= "containerBottoniFaqs"  style="margin-top:70px">

            <div> <button onclick="window.location.href='{{ route('Amministratore') }}'" class="bottoneAdminFaq" style="background-color: #1A76D1;">Torna indietro</button></div>
            <div> <a href="{{route('FaqStorePage')}}"><button class="bottoneAdminFaq" style="background-color: #1A76D1;">Aggiungi Faq</button></a></div>
            </div>
	</div>




@endisset()
@endsection

