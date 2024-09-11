@extends('layouts.user')

@section('content')
<div class="container">
    <h1 style="text-align:center; margin-top: 30px;margin-bottom:30px">Aggiungi una Nuova FAQ</h1>

    <!-- Form di tipo POST per aggiungere una nuova FAQ -->
    {{ html()->form('POST', route('faq.store'))
    ->attribute('onsubmit', 'return confirm("Sei sicuro di voler aggiungere questa FAQ?");')->open() }}
        <div class="form-group">
            {{ html()->label('Domanda', 'Domanda')->class('labelFaqAdmin')}}
            {{ html()->textarea('Domanda')
                ->class('formDomandaFaq')->placeholder('Inserisci la domanda')->required() }}
        </div>

        <div class="form-group">
            {{ html()->label('Risposta', 'Risposta')->class('labelFaqAdmin')}}
            {{ html()->textarea('Risposta')
                ->class('formRispostaFaq')->placeholder('Inserisci la risposta')->required() }}
        </div>

        <div class="form-group">
            {{ html()->hidden('_token', csrf_token()) }}
        </div>

        <div class= "containerBottoniFaqs" >
            <a href="{{route('FaqAdmin')}}"><button type="button" class="bottoneAdminFaq" style="background-color: #1A76D1;">Torna indietro</button></a>
            {{ html()->button('Aggiungi FAQ')->type('submit')->class('bottoneAdminFaq')->style('background-color: #1A76D1;') }}
        </div>
    {{ html()->form()->close() }}
</div>
@endsection