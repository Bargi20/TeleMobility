@extends('layouts.user')

@section('content')

<div class="container">
    <h1 style="text-align:center; margin-top: 30px;margin-bottom:30px">Aggiungi un nuovo disturbo:</h1>

        @if (session('error'))
            <div class="alert-error">
                <span class="alert-icon">❌</span>
                <span class="alert-message">{{ session('error') }}</span>
            </div>
        @endif

        {{ html()->form('POST', route('disturbo.store'))
        ->attribute('onsubmit', 'return validateForm()')->open() }}
            <div class="form-group">
                {{ html()->label('Nome Disturbo:', 'Nome_Disturbo')->class('labelFaqAdmin')}}
                <!--Se ci metto required e invio la form senza compilarla esce un piccolo messaggio di errore-->
                {{ html()->textarea('Nome_Disturbo')->class('formDomandaFaq')->placeholder('Inserisci il nome del disturbo')->required() }}
            </div>

            <div class="form-group">
                {{ html()->label('Descrizione Disturbo:', 'disturbo')->class('labelFaqAdmin')}}
                {{ html()->textarea('Descrizione')->id('disturbo')->class('formDomandaFaq')->placeholder('Inserisci la descrizione del disturbo')->required()}}
            </div>

                {{ html()->hidden('_token', csrf_token()) }}
            

            <div class= "containerBottoniFaqs" >
                <a href="{{route('DisturbiAdmin')}}"><button type="button" class="bottoneAdminFaq" style="background-color: #1A76D1;border-radius :0.4em;">Torna indietro</button></a>
                {{ html()->button('Aggiungi disturbo')->type('submit')->class('bottoneAdminFaq')->style('background-color: #1A76D1;border-radius :0.4em;') }}
            </div>
        {{ html()->form()->close() }}
    
</div>

<script>
function validateForm() {
    var disturbo = document.getElementById('Nome_Disturbo').value;

    if (disturbo.length > 250) {
        alert('Il disturbo ha una lunghezza max consentita di 250 caratteri!')
        return false; // Previene l'invio della form
    }
    return confirm("Sei sicuro di voler aggiungere questo disturbo?");
    
}
</script>

@endsection