@extends('layouts.user')

@section('content')
<div class="container">
    <br>
    {{ html()->form('POST', route('diagnosi.store'))->acceptsFiles()->open() }}
    <div class="containerInserisci" style = " margin-bottom:3%">
        <div style="padding-top: 1%">
        <h3>Inserisci Evento </h3><br>
        </div>
    <br>
    <div style="display: flex;">
        <div style="width: 15%;">
            {{ html()->label('Seleziona Disturbo','Disturbi') }}
        </div>
        <div style="width: 1%;"></div>
        <div>
            {{ html()->select('ID_Disturbo', $disturbi)->placeholder('Seleziona Disturbo')->attribute('class', 'custom-select') }}
        </div>
    </div>
    <div style="display: flex; padding-top: 0.5%">
        <div style="width: 15%;">
            {{ html()->label('Seleziona Data:') }}
        </div>
        <div style="width: 1%;"></div>

            {{ html()->date('Data_Evento')->attribute('min', '1940-01-01')->attribute('max', date('Y-m-d')) }}     

    </div>
    <div style="display: flex; padding-top: 0.5%">
        <div style="width: 15%;">
            {{ html()->label('Inserisci orario evento:') }}
        </div>
        <div style="width: 1%;"></div>
        <div>
            {{ html()->time('Orario') }}
        </div>
    </div>
    <div style="display: flex;padding-top: 1%;">
        <div style="width: 15%;">
            {{ html()->label(' Durata: ') }}
        </div>
        <div style="width: 1%"></div>
        <div>
            {{ html()->input('number', 'Durata')->attributes(['min' => '0', 'step' => '1'])->placeholder('0') }}
        </div>
    </div>
    <div style="display: flex;padding-top: 1%;" >
        <div style="width: 15%;">
            {{ html()->label(' Intensità: ') }}
        </div>
        <div style="display:flex; width: 1%;"></div>
        <div>
            {{ html()->select('Intensita')->options(array_combine(range(1, 10), range(1, 10))) }}
        </div>
    </div>
    </div>
    <div>
        <button type="submit" class="bottoneCartella1">Salva</button>
        {{ html()->form()->close() }}

    </div>  
    <div style="margin-top:0.5%">
    <button onclick="window.location.href='{{route('Paziente')}}'" class="bottoneCartella1"> Indietro </button>
    </div>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>            

        </div>
    @endif
</div>
<script>
     document.addEventListener('DOMContentLoaded', function() {
            var birthdateInput = document.querySelector('input[name="DataDiNascita"]');
            birthdateInput.addEventListener('input', function() {
                var date = new Date(this.value);
                var year = date.getFullYear();
                if (year < 1940 || year > new Date().getFullYear()) {
                    this.setCustomValidity('La data deve essere compresa tra il 1940 e oggi.');
                } else {
                    this.setCustomValidity('');
                }
            });
        });
</script>
@endsection






