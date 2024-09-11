@extends('layouts.user')

@section('content')

<div class="container">
    <h1 style="text-align:center; margin-top: 30px;margin-bottom:30px">Aggiungi un nuovo farmaco:</h1>

        @if (session('error'))
            <div class="alert-error">
                <span class="alert-icon">❌</span>
                <span class="alert-message">{{ session('error') }}</span>
            </div>
        @endif

        {{ html()->form('POST', route('farmaco.store'))
        ->attribute('onsubmit', 'return validateForm()')->open() }}
            <div class="form-group">
                {{ html()->label('Nome Farmaco:', 'Nome_Farmaco')->class('labelFaqAdmin')}}
                <!--Se ci metto required e invio la form senza compilarla esce un piccolo messaggio di errore-->
                {{ html()->textarea('Nome_Farmaco')->class('formDomandaFaq')->placeholder('Inserisci il nome del farmaco')->required() }}
            </div>

            <div class="form-group">
                {{ html()->label('Descrizione Farmaco:', 'Descrizione')->class('labelFaqAdmin')}}
                <!--Se ci metto required e invio la form senza compilarla esce un piccolo messaggio di errore-->
                {{ html()->textarea('Descrizione')->class('formDomandaFaq')->placeholder('Inserisci la descrizione del farmaco')->required() }}
            </div>

            

                {{ html()->hidden('_token', csrf_token()) }}
            

            <div class= "containerBottoniFaqs" >
                <a href="{{route('FarmaciAdmin')}}"><button type="button" class="bottoneAdminFaq" style="background-color: #1A76D1;border-radius :0.4em;">Torna indietro</button></a>
                {{ html()->button('Aggiungi farmaco')->type('submit')->class('bottoneAdminFaq')->style('background-color: #1A76D1;border-radius :0.4em;') }}
            </div>
        {{ html()->form()->close() }}
    
</div>

<script>
function validateForm() {
    var farmaco = document.getElementById('Nome_Farmaco').value;

    if (farmaco.length > 250) {
        alert('Il nome del farmaco ha una lunghezza max consentita di 250 caratteri!')
        return false; // Previene l'invio della form
    }

    var descrizione = document.getElementById('Descrizione').value;

    
    return confirm("Sei sicuro di voler aggiungere questo farmaco?");
    
}




</script>

@endsection