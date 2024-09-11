@extends('layouts.user')

@section('content')
<div class="container">
    <h1 style="text-align:center; margin-top: 30px;margin-bottom:30px">Modifica il disturbo selezionato:</h1>

    @if (session('error'))
        <div class="alert-error">
            <span class="alert-icon">❌</span>
            <span class="alert-message">{{ session('error') }}</span>
        </div>
    @endif
    
    <!--Form che usa il metodo PUT per aggiornare il DB-->
    {{ html()->form('PUT', route('disturbo.update', [$disturbo->Id_Disturbo]))->acceptsFiles()                                    
        ->attribute('onsubmit', 'return validateForm()')->open()}}
    
    <div class="form-group">
        {{ html()->label('Nome Disturbo:', 'disturbo')->class('labelFaqAdmin')}}
        {{ html()->textarea('Nome_Disturbo')->id('disturbo')->class('formDomandaFaq')->value($disturbo->Nome_Disturbo)->required()}}
    </div>
    <div class="form-group">
        {{ html()->label('Descrizione Disturbo:', 'disturbo')->class('labelFaqAdmin')}}
        {{ html()->textarea('Descrizione')->id('disturbo')->class('formDomandaFaq')->value($disturbo->Descrizione)->required()}}
    </div>
    

    {{ html()->hidden('_token', csrf_token()) }}

    <div class= "containerBottoniFaqs" >
        <a href="{{route('DisturbiAdmin')}}"><button type="button" class="bottoneAdminFaq" style="background-color: #1A76D1;border-radius :0.4em;">Torna indietro</button></a>
        {{ html()->button('Aggiorna Disturbo')->type('submit')->class('bottoneAdminFaq')->style('background-color: #1A76D1;border-radius :0.4em;')->name('submitDisturbo_' . $disturbo) }}
    </div>

    {{ html()->form()->close() }}
</div>


<script>
function validateForm() {
    //prende l'input con id disturbo
    var disturbo = document.getElementById('disturbo').value;

    //vede se i caratteri sono più di 250
    if (disturbo.length > 250) {
        alert('Il disturbo ha una lunghezza max consentita di 250 caratteri!')
        return false; // Previene l'invio della form
    }
    return confirm("Sei sicuro di voler modificare questo disturbo?")
    
}
</script>
@endsection