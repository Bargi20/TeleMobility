@extends('layouts.user')


@section('content')

<div class="container">
    

    <form id="searchForm" class="form-container">
        @csrf
        <div>
            <label for="intensità">Filtra Evento Per Intensità Minima</label>
            <input type="number" id="intensità" name="intensità" min="1" max="10">
        </div>
      
        <div>
            <label for="intensità2">Filtra Evento Per Intensità Massima</label>
            <input type="number" id="intensità2" name="intensità2" min="1" max="10">
        </div>
        <div style="margin-bottom: 2.35em">
            <label for="ID_Disturbo" style="margin-top: 1.9em">Filtra Evento Per Disturbo</label>
            {{ html()->select('ID_Disturbo', $disturbi)->placeholder('Seleziona Disturbo') }}
        </div>
        <div>
            <button type="submit" class="bottoneCartella1" style="margin-top: 3em">Cerca</button>
        </div>
    </form>

        <div id="initialResults">
            @foreach ($eventiDisturbo as $evento)
                <div class="containerEvento" style="margin-top: 2%">
                    <div class="event-infoEvento">
                        <h2>Evento Disturbo</h2>
                        <p><strong>Disturbo: </strong> {{ ($evento->getDisturboBy_Id($evento->ID_Disturbo))->Nome_Disturbo}}</p> 
                        <p><strong>Data: </strong> {{ $evento->Data_Evento}}</p>
                        <p><strong>Orario: </strong> {{ $evento->Orario }}</p>
                        <p><strong>Durata: </strong>{{ $evento->Durata }} Secondi</p>
                        <p><strong>Intensità: </strong> {{ $evento->Intensità }}</p>
                  
                    </div>
                </div>
            @endforeach
        </div>
        
        <div id="results" style="display: none;"></div>
    
        <div class="container">@include('pagination.paginator', ['paginator' => $eventiDisturbo])</div>
    
        <button onclick='window.history.back()' class="bottoneCartella1">Torna Indietro</button>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
   $(document).ready(function() {
    $('#searchForm').on('submit', function(event) {
        event.preventDefault();

        let intensità = $('#intensità').val();
        let intensità2 = $('#intensità2').val();
        let ID_Disturbo = $('#ID_Disturbo').val();
        let pazienteId = parseInt("{{$Paziente}}");

        $.ajax({
            url: '{{ route('filtraEventi', ['ID_Paziente' => ':pazienteId']) }}'.replace(':pazienteId', pazienteId),
            method: 'GET',
            data: {
                intensità: intensità,
                intensità2: intensità2, 
                ID_Disturbo: ID_Disturbo
            },
            success: function(response) {
                $('#initialResults').hide();

                $('#results').empty().show();

                if (response.length > 0) {
                    response.forEach(evento => {
                        let eventHtml = `
                            <div class="containerEvento" data-id="${evento.ID}" style="margin-top: 2%">
                                <div class="event-infoEvento">
                                    <h2>Evento Disturbo</h2>
                                    <p><strong>Disturbo: </strong> ${evento.Nome_Disturbo}</p>
                                    <p><strong>Data: </strong> ${evento.Data_Evento}</p>
                                    <p><strong>Orario: </strong> ${evento.Orario}</p>
                                    <p><strong>Durata: </strong> ${evento.Durata} Secondi</p>
                                    <p><strong>Intensità: </strong> ${evento.Intensità}</p>
                                </div>
                            </div>
                        `;
                        $('#results').append(eventHtml);
                    });
                } else {
                    $('#results').append('<div>Nessun Evento trovato</div>');
                }
            },
            error: function() {
                $('#results').append('<div>Errore nella ricerca</div>');
            }
        });
    });
});

document.getElementById('searchForm').addEventListener('submit', function(event) {
    var minIntensity = document.getElementById('intensità').value;
    var maxIntensity = document.getElementById('intensità2').value;

    if (minIntensity < 0 || minIntensity > 10) {
        alert('L\'intensità minima deve essere compresa tra 0 e 10.');
        event.preventDefault(); // Previene l'invio del modulo
    }

    if (maxIntensity < 0 || maxIntensity > 10) {
        alert('L\'intensità massima deve essere compresa tra 0 e 10.');
        event.preventDefault(); // Previene l'invio del modulo
    }
});


</script>
    
    @endsection
    