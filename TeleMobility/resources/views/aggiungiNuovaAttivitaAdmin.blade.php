@extends('layouts.user')

@section('content')

<div class="container">
    <h1 style="text-align:center; margin-top: 30px;margin-bottom:30px">Aggiungi una nuova Attività:</h1>

        @if (session('error'))
            <div class="alert-error">
                <span class="alert-icon">❌</span>
                <span class="alert-message">{{ session('error') }}</span>
            </div>
        @endif

        {{ html()->form('POST', route('attività.store'))
        ->attribute('onsubmit', 'return validateForm()')->open() }}
            <div class="form-group">
                {{ html()->label('Nome Attività:', 'Nome_Attività')->class('labelFaqAdmin')}}
                <!--Se ci metto required e invio la form senza compilarla esce un piccolo messaggio di errore-->
                {{ html()->textarea('Nome_Attività')->class('formDomandaFaq')->placeholder('Inserisci il nome dell\'attività')->required() }}
            </div>

            <div class="form-group">
                {{ html()->label('Descrizione Attività:', 'Descrizione')->class('labelFaqAdmin')}}
                <!--Se ci metto required e invio la form senza compilarla esce un piccolo messaggio di errore-->
                {{ html()->textarea('Descrizione')->class('formDomandaFaq')->placeholder('Inserisci la descrizione dell\'attività')->required() }}
            </div>

            

                {{ html()->hidden('_token', csrf_token()) }}


            <div class= "containerBottoniFaqs" >
                <button onclick="window.location.href='{{route('Amministratore')}}'" class="bottoneAdminFaq" type="button" style="background-color: #1A76D1;border-radius :0.4em;"> Indietro </button>                

                {{ html()->button('Aggiungi Attività')->type('submit')->class('bottoneAdminFaq')->style('background-color: #1A76D1;border-radius :0.4em;') }}
            </div>
        {{ html()->form()->close() }}
    
</div>

<script>
function validateForm() {
    var elemento = document.getElementById('Nome_Attività').value;

    if (elemento.length > 250) {
        alert('Il nome del farmaco ha una lunghezza max consentita di 250 caratteri!')
        return false; // Previene l'invio della form
    }

    var descrizione = document.getElementById('Descrizione').value;

    
    return confirm("Sei sicuro di voler aggiungere quest\'attività?");
    
}
</script>

@endsection