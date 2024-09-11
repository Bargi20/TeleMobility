@extends('layouts.user')

@section('content')


<div class="container">

    <form>
        <label for="search">Cerca Paziente:</label>
        <input type="text" id="search" name="search">
    </form>

    <ul id="patientList" class="patient-list1">
        <!-- Lista dei pazienti già popolata -->
        @foreach ($pazienti as $paziente)
            <li>
                <a href="{{ route('PazienteSelezionato', $paziente->id) }}">  
                    <div class="rettangoloPaziente1">
                        <div class="col-lg-6-adattato2"> 
                            <div class="cerchioPaziente">
                                <img src="{{ asset('images/' . $paziente->Immagine) }}" alt="foto paziente" class="imgCerchioPaziente">            
                            </div>
                            <h4 class="patient-title">Paziente: {{$paziente->name}} {{$paziente -> surname}} </h4>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
    <div id="emptyMessage" style="display: none;">Nessun paziente trovato.</div>

    <button onclick="window.location.href='{{route('Clinico')}}'" class="bottoneAdmin" style="margin-top:2em"> Torna Indietro </button>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();

            $.ajax({
            url: '{{ route('search-pazienti') }}',
            type: 'GET',
            data: {'query': query},
            success: function(data) {
                $('#patientList').empty(); // Svuota la lista dei pazienti
                if (data.length > 0) {
                    // Se ci sono pazienti trovati, aggiungi ogni paziente alla lista
                    data.forEach(function(patient) {
                        var immagineUrl = '{{ asset("images/") }}' + patient.immagine; 
                        var patientHTML = `
                            <li>
                                <a href="{{ url('Dottore/Ricerca-Paziente/Paziente_selezionato') }}/${patient.id}">                                      
                                    <div class="rettangoloPaziente1">
                                        <div class="col-lg-6-adattato2">
                                            <div class="cerchioPaziente">
                                                <img src="{{ asset('images/') }}/${patient.Immagine}" alt="foto paziente" class="imgCerchioPaziente">            
                                            </div>
                                            <h4 class="patient-title">Paziente: ${patient.name} ${patient.surname}</h4>
                                        </div>
                                    </div>
                                </a> 
                            </li>
                        `;
                        $('#patientList').append(patientHTML); // Aggiungi il paziente alla lista
                    });
                    // Nascondi il messaggio di lista vuota
                    $('#emptyMessage').hide();
                } else {
                    // Se la lista dei pazienti è vuota, mostra il messaggio di lista vuota
                    $('#emptyMessage').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('Errore:', status, error);
            }
        });
    });
});
</script> 
    
    
   
    <div class="container">@include('pagination.paginator', ['paginator' => $pazienti])</div>
</div>

@endsection

