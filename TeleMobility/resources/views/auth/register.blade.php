@extends('layouts.public')

@section('title', 'Registrazione')

@section('content')
<div class="static">
    <h3>Registrazione</h3>
    <p>Utilizza questa form per registrarti al sito</p>

    <div class="container-contact">
        <div class="wrap-contact1">
            {{ html()->form()->route('register')->class(['contact-form'])->open() }}

            <div  class="wrap-input">
                {{ html()->label('Nome', 'name')->class(['label-input']) }}
                {{ html()->text('name')->class(['input'])->id('name') }}
                @if ($errors->first('name'))
                <ul class="errors">
                    @foreach ($errors->get('name') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div  class="wrap-input">
                {{ html()->label('Cognome', 'surname')->class(['label-input']) }}
                {{ html()->text('surname')->class(['input'])->id('surname') }}
                @if ($errors->first('surname'))
                <ul class="errors">
                    @foreach ($errors->get('surname') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

             <div  class="wrap-input">
                {{ html()->label('Email', 'email')->class(['label-input']) }}
                {{ html()->email('email')->class(['input'])->id('email') }}
                @if ($errors->first('email'))
                <ul class="errors">
                    @foreach ($errors->get('email') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

             <div  class="wrap-input">
                {{ html()->label('Nome Utente', 'username')->class(['label-input']) }}
                {{ html()->text('username')->class(['input'])->id('username') }}
                @if ($errors->first('username'))
                <ul class="errors">
                    @foreach ($errors->get('username') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

             <div  class="wrap-input">
                {{ html()->label('Password', 'password')->class(['label-input']) }}
                {{ html()->password('password')->class(['input'])->id('password') }}
                @if ($errors->first('password'))
                <ul class="errors">
                    @foreach ($errors->get('password') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div  class="wrap-input">
                {{ html()->label('Conferma password', 'password-confirm')->class(['label-input']) }}
                {{ html()->password('password_confirmation')->class(['input'])->id('password-confirm') }} <!--viene attivato
                     al lato server per fare un confronto che viene gestito da una parte dal package html e a breeze abilità
                      la validazione-->
            </div>

            <div class="container-form-btn">
                {{ html()->submit('Registra')->class(['form-btn1']) }}
            </div>

            {{ html()->form()->close() }}
        </div>
    </div>

</div>
@endsection
