@extends('layouts.user')


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




@section('content')


<div class="container">
<h1 style="text-align:center;margin-top:30px;margin-bottom:50px">Sezione di analisi dati</h1>
    
    <div class="row">
        <div class="col-md-6">
            <!-- FORM per la ricerca dei pazienti -->
            <h4>Statistiche sulle terapie dei pazienti:</h4>

            {{ html()->form('GET', route('paziente.search'))->id('searchForm')->open() }}
            {{ html() ->text()->class('barraRicerca')->style('border: 2px solid #1A76D1')->id('search')-> name('query')->placeholder('Scrivi il nome del paziente')}}
            {{ html()->form()->close() }}



            <!--Lista di pazienti-->
            <ul id="results"></ul>
            
                


        </div>

        <div class="col-md-6">
            <div class="containerDeiCerchi">
                <div class="circle">
                    Ogni clinico ha un <span style='color: #1A76D1;'> numero medio</span> di pazienti seguiti pari a <br>
                    <h2 style="color:#1A76D1;text-align:center;margin-top:10px"> {{$media1puntoArrotondata}} </h2>
                </div>
                <div class="circle media2Punto" id="media2">
                    Selezionando un paziente, si può vedere la sua<span style="color:#1A76D1"> media degli eventi </span>registrati<br>
                </div>
            </div>
        </div>
    </div>



<!--Anche questo su Faq.js non va-->
<script type="text/javascript">
        $(document).ready(function() {
            //serve per non far inviare la form in caso si prema invio, altrimenti mi porta in una pagina grezza
            //con i dati del paziente
            $('#searchForm').on('submit', function(event) {
                event.preventDefault(); // Prevenire l'invio del form
            });
            //qui si effettua una ricerca dinamica mentre l'utente digita nella form
            $('#search').on('keyup', function() {
                let query = $(this).val();
                //se digita almeno 3 caratteri, viene fatta la richiesta ajax, di tipo get, alla rotta paziente.search che richiamerà il controller
                //con query che è quello che stiamo digitando
                if (query.length > 2) {
                    $.ajax({
                        url: "{{ route('paziente.search') }}",
                        type: "GET",
                        data: { query: query },
                        success: function(data) {
                            //Prima di visualizzare i risultati della ricerca, è importante assicurarci che la lista sia vuota. Usiamo $('#results').empty() per eliminare tutti 
                            //gli elementi <li> presenti all'interno dell'elemento con l'ID #results.
                            $('#results').empty();
                            if (data.length > 0) {
                                //iteriamo sui pazienti
                                $.each(data, function(index, patient) {
                                    //per ciascuno di questi creiamo una lista che visualizzeremo con nome e cognome
                                    $('#results').append
                                    ('<li class="nomePaziente" data-id="' + patient.id + '">'+ patient.name + ' ' + patient.surname + '</li>');
                                });

                                //qui viene gestito l'evento del click sul paziente
                                $('.nomePaziente').on('click', function() {
                                    //otteniamo l'iD ed il nome del paziente su cui clicchiamo
                                    let patientName = $(this).text();

                                    let patientId = $(this).data('id');
                                    let $this = $(this);
                                    let $media2 = $('#media2Punto');

                                // Controlla se i dettagli della terapia sono già presenti
                                //se non è stata mostrata nessuna terapia mi permette di mostrarla, altrimenti no
                                //è per evitare che ad ogni click si aggiungano terapie sotto al paziente che diventerebbero più di una
                                if (!$('.terapiaDetails').length) {
                                    //grazie all'ID possiamo ricavare tramite la rotta, la richiesta ajax ed il controllore,
                                    //la terapia associata al paziente.
                                        $.ajax({
                                            url: "{{ url('/Admin/Statistiche/terapia') }}/" + patientId,
                                            type: "GET",
                                            success: function(response) {
                                                //Qui invece creiamo i contenuti da mostrare al click, in base a vari fattori
                                                let terapiaContent = '';
                                                //se è la prima e unica terapia
                                                if (response.terapia == 1) {
                                                    terapiaContent = 'Il paziente è seguito dal clinico <span style="color: #1A76D1;">' + response.dottoreDelPaziente + '</span>. <br> Gli è stata prescritta <span style="color: #1A76D1;">una</span> terapia.';
                                                }//se ne ha più di una
                                                 else if (response.terapia > 1) {
                                                    terapiaContent = 'Il paziente è seguito dal clinico <span style="color: #1A76D1;">' + response.dottoreDelPaziente + '</span>. <br> Ha cambiato <span style="color: #1A76D1;">' + response.terapia + '</span> terapie.';
                                                }//se non ha terapie 
                                                else {
                                                    terapiaContent = 'Il paziente è seguito dal clinico <span style="color: #1A76D1;">' + response.dottoreDelPaziente + '</span>. <br> Non gli è stata prescritta <span style="color: #1A76D1;">nessuna</span> terapia.';
                                                }
                                                //se non ha un clinico assegnato
                                                if (!response.dottoreDelPaziente) {
                                                    terapiaContent = 'Il paziente non è seguito ancora da <span style="color: #1A76D1;">nessun clinico!</span>';
                                                }
                                                console.log('Media', response.media2Arrotondata)
                                                // Inserisco i dettagli della terapia dopo l'elemento cliccato, ricavato con $this all'inizio della funzione
                                                $('<div class="terapiaDopoIlClick" style="color:black">' + terapiaContent + '</div>').insertAfter($this);
                                                //inserisce il nome nella 2 div laterale

                                                $('#media2').html("Il paziente <span style='color: #1A76D1;'>" + patientName + "</span> ha una media di eventi registrati pari a: <br>" + "<h2 style='color: #1A76D1;text-align:center'>"+response.media2Arrotondata+"</h2>");



                                            },
                                            error: function() {
                                                console.log('Errore nel recupero dei dettagli della terapia.');
                                            }
                                        });
                                    }
                                });
                             //se la query non trova nessun paziente visualizza un errore che viene inserito in <ul id = "results"> come elemento di una lista
                            } else {
                                $('#results').append('<li class="nomePazienteNonTrovato">❌ Paziente non trovato!</li>');
                                
                            }
                        }
                    });

                    //risvuola la lista
                } else {
                    $('#results').empty();
                }
                //se faccio una nuova ricerca si nasconde la risposta per la terapia ecc..
                $('.terapiaDopoIlClick').hide();

            });
        });
        //se schiaccio da qualsiasi altra parte si nasconde la risposta per la terapia, il nome del paziente ecc..
        $(document).on('click', function(event) {
        if (!$(event.target).closest('.terapiaDopoIlClick').length && !$(event.target).is('#search')) {
            $('.terapiaDopoIlClick').hide();
            //inoltre ripristino la scritta iniziale, altrimenti rimane quella dell'ultimo paziente selezionato
            $('#media2').html("Selezionando un paziente, si può vedere la sua<span style='color:#1A76D1'> media degli eventi </span>registrati<br>");

            
        }
});
</script>




</div>

<h1 style="margin-top:60px;text-align:center">Dati sui disturbi</h1>

<div class="divGrafico">
    <!--Con canvas posso fare il grafico-->
    <canvas id="barChart" style="margin-right:100px"></canvas>
    <div style="padding-left:165px; padding-top: 40px" >
        <button onclick="window.location.href='{{route('Amministratore')}}'" class="bottoneCartella1"> Indietro </button>
        </div>
</div>




<!--Conviene tenere tutto lo script qui perchè su un .js non va-->

<script type="text/javascript">
        //colore del testo
        Chart.defaults.color = '#000';
        //grandezza dei caratteri
        Chart.defaults.font.size = 16;



        // Anche se dà errore funziona
        //teoricamente serve per passare i dati in formato Json
        var labels = {!! json_encode($labels) !!};
        var data = {!! json_encode($data) !!};

        console.log('Dati del grafico:', labels);
        console.log('Dati del grafico:', data);


        var ctx = document.getElementById('barChart').getContext('2d');
        //crea un nuovo grafico
        var myChart = new Chart(ctx, {
            
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Numero di eventi registrati per disturbo',
                    data: data,
                    //colore e bordo delle barre
                    backgroundColor: '#1A76D1',
                    /*
                    borderColor: '#1A76D1',
                    borderWidth: 1,*/
                }]
            },
            options: {
                //così ho le barre orizzontali, se non ce lo metto di default sono verticali e si scambiano
                //automaticamente ascisse e ordinate.
                indexAxis: 'y',

                scales: {
                    y: {
                        beginAtZero: true,
                        
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeInOutBounce'
                },
                plugins: {
                    categorySpacing: 10, // Aggiunge spazio tra le barre

                    //si deve vedere la legenda, testo nero e size a 20
                    legend: {
                    display: true,
                        labels: {
                            color: 'black',
                            
                            font:{
                                size:20,
                            }
                            }
                    }
                
                },
            }
        });
    </script>

    






@endsection


