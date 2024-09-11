@extends('layouts.user')

@section('content')
<div class="container">
    <h1 style="text-align:center; margin-top: 30px;margin-bottom:30px">Modifica l'attività riabilitativa selezionata:</h1>

    @if (session('error'))
        <div class="alert-error">
            <span class="alert-icon">❌</span>
            <span class="alert-message">{{ session('error') }}</span>
        </div>
    @endif
    
    <!--Form che usa il metodo PUT per aggiornare il DB-->
    {{ html()->form('PUT', route('attività.update', [$attività->Id_Attività_Riabilitative]))->acceptsFiles()                                    
        ->attribute('onsubmit', 'return validateForm()')->open()}}
    
    <div class="form-group">
        {{ html()->label('Nome Attività:', 'attività')->class('labelFaqAdmin')}}
        {{ html()->textarea('Nome_Attività')->id('attività')->class('formDomandaFaq')->value($attività->Nome_Attività)->required()}}
    </div>

    <div class="form-group">
        {{ html()->label('Descrizione Attività:', 'attività')->class('labelFaqAdmin')}}
        {{ html()->textarea('Descrizione')->id('attività')->class('formDomandaFaq')->value($attività->Descrizione)->required()}}
    </div>
    
    

    {{ html()->hidden('_token', csrf_token()) }}

    <div class= "containerBottoniFaqs" >
        <a href="{{route('AttivitaAdmin')}}"><button type="button" class="bottoneAdminFaq" style="background-color: #1A76D1;border-radius :0.4em;">Torna indietro</button></a>
        {{ html()->button('Aggiorna Attività')->type('submit')->class('bottoneAdminFaq')->style('background-color: #1A76D1;border-radius :0.4em;')->name('submitAttività' . $attività) }}
    </div>

    {{ html()->form()->close() }}
</div>


<script>
function validateForm() {
    var elemento = document.getElementById('Nome_Attività').value;

    if (elemento.length > 250) {
        alert('Il nome dell\'attività ha una lunghezza max consentita di 250 caratteri!')
        return false; // Previene l'invio della form
    }
    
    return confirm("Sei sicuro di voler modificare quest\'attività?");
    
}
</script>
@endsection