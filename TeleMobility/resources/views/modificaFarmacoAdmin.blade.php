@extends('layouts.user')

@section('content')
<div class="container">
    <h1 style="text-align:center; margin-top: 30px;margin-bottom:30px">Modifica il farmaco selezionato:</h1>

    @if (session('error'))
        <div class="alert-error">
            <span class="alert-icon">❌</span>
            <span class="alert-message">{{ session('error') }}</span>
        </div>
    @endif
    
    <!--Form che usa il metodo PUT per aggiornare il DB-->
    {{ html()->form('PUT', route('farmaco.update', [$farmaco->ID_Farmaco]))->acceptsFiles()                                    
        ->attribute('onsubmit', 'return validateForm()')->open()}}
    
    <div class="form-group">
        {{ html()->label('Nome Farmaco:', 'farmaco')->class('labelFaqAdmin')}}
        {{ html()->textarea('Nome_Farmaco')->id('farmaco')->class('formDomandaFaq')->value($farmaco->Nome_Farmaco)->required()}}
    </div>

    <div class="form-group">
        {{ html()->label('Descrizione Farmaco:', 'farmaco')->class('labelFaqAdmin')}}
        {{ html()->textarea('Descrizione')->id('farmaco')->class('formDomandaFaq')->value($farmaco->Descrizione)->required()}}
    </div>
    
    

    {{ html()->hidden('_token', csrf_token()) }}

    <div class= "containerBottoniFaqs" >
        <a href="{{route('FarmaciAdmin')}}"><button type="button" class="bottoneAdminFaq" style="background-color: #1A76D1;border-radius :0.4em;">Torna indietro</button></a>
        {{ html()->button('Aggiorna Farmaco')->type('submit')->class('bottoneAdminFaq')->style('background-color: #1A76D1;border-radius :0.4em;')->name('submitFarmaco' . $farmaco) }}
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
    
    return confirm("Sei sicuro di voler modificare questo farmaco?");
    
}
</script>
@endsection