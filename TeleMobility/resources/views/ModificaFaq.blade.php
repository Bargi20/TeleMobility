@extends('layouts.user')

@section('content')


<div class="container">
    <h1 style="text-align:center; margin-top: 30px;margin-bottom:30px">Modifica la Faq selezionata:</h1>
    
    <!--Form che usa il metodo PUT per aggiornare il DB-->
    {{ html()->form('PUT', route('faq.update', [$faq->Id_Faq]))->acceptsFiles()                                    
        ->attribute('onsubmit', 'return confirm("Sei sicuro di voler modificare questa FAQ?");')->open()}}
    
    <div class="form-group">
        {{ html()->label('Domanda:', 'question')->class('labelFaqAdmin')}}
        {{ html()->textarea('Domanda')->class('formDomandaFaq')->value($faq->Domanda) }}
    </div>
    
    <div class="form-group">
        {{ html()->label('Risposta:', 'answer')->class('labelFaqAdmin')}}
        {{ html()->textarea('Risposta')->class('formRispostaFaq')->value($faq->Risposta) }}
    </div>

    {{ html()->hidden('_token', csrf_token()) }}
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>            

    </div>
@endif
    <div class= "containerBottoniFaqs" >
        <a href="{{route('FaqAdmin')}}"><button type="button" class="bottoneAdminFaq" style="background-color: #1A76D1;">Torna indietro</button></a>
        {{ html()->button('Aggiorna FAQ')->type('submit')->class('bottoneAdminFaq')->style('background-color: #1A76D1;')->name('submitFaq_' . $faq) }}
    </div>

    {{ html()->form()->close() }}
</div>
@endsection