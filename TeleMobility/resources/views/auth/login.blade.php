@extends('layouts.public')

@section('title', 'Login')

@section('content')

<div class="login-container">
    <div class="login-header">

        <h3>Login</h3>
        <p>Utilizza questa form per autenticarti al sito</p>
    </div>

    {{ html()->form()->route('login')->class(['contact-form'])->open() }}

    <div class="wrap-input">
        {{ html()->label('Nome Utente', 'username')->class(['label-input'])->style('display:none;') }}
        {{ html()->text('username')->class(['input'])->id('username')->placeholder('Nome Utente') }}
       
    </div>

    <div class="wrap-input">
        {{ html()->label('Password', 'password')->class(['label-input'])->style('display:none;') }}
        {{ html()->password('password')->class(['input'])->id('password')->placeholder('Password') }}
        
        @if ($errors->first('username'))
  
            <ul class="errors" style="padding-top: 5%">
                @foreach ($errors->get('username') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @endif
        @if ($errors->first('password'))
            <ul class="errors">
                @foreach ($errors->get('password') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @endif
    

    <div class="container-form-btn">
        {{ html()->submit('Login')->class(['form-btn1']) }}
    </div>

    {{ html()->form()->close() }}

</div>
</div>
@endsection
