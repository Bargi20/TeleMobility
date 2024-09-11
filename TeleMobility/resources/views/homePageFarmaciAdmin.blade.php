@extends('layouts.user')


@section('content')


    


<div class="container">

<style>
        .ciao:focus,
.ciao:active {
    outline: none; /* Rimuove il bordo attorno al bottone */
}
</style>

<h1 style="text-align:center; margin-top: 30px;margin-bottom:50px">Elenco dei farmaci per le terapie:</h1>

        @if (session('success'))
                <div class="alert-success">
                <span class="alert-icon">✔️</span>
                <span class="alert-message">{{ session('success') }}</span>
                
                </div>
         @endif

   @foreach ($farmaci as $farmaco) 
        <div class="containerDisturbiAdmin" >
                <div class="divDisturbo"> 
                        <h4 class="h4Disturbo"> {{$farmaco->Nome_Farmaco}} </h4>
                        <button class="ciao" data-id="{{ $farmaco->ID_Farmaco }}" style="font-size: 27px;background-color: transparent;border:none">▶️</button>
                </div>


                        <div class= "containerBottoniDisturbi" style="display:flex;padding-top:10px;padding-bottom:10px;flex-direction: column;" >

                        
                        {{ html()->form('DELETE', route('farmaco.destroy', $farmaco->ID_Farmaco))
                                ->attribute('onsubmit', 'return confirm("Sei sicuro di voler eliminare questo farmaco?");')
                                ->open() }}
                                
                                
                        {{ html()->hidden('_token', csrf_token()) }}
                        {{ html()->button('Elimina')->type('submit')->class('bottoneAdminDisturbi')->style('background-color:#e70000;margin-top:5px;')}}
                        {{ html()->form()->close() }}


                        {{ html()->form('GET', route('farmaco.edit', $farmaco->ID_Farmaco))->open() }}

                        {{ html()->hidden('_token', csrf_token()) }}
                        {{ html()->button('Modifica')->type('submit')->class('bottoneAdminDisturbi')->style('color:black;background-color: #f2f2f2;margin-top:5px;') }}

                        {{ html()->form()->close() }}
                        </div>
                        
                        
                        
                                        
        </div>

        <div class="divDisturbo" id="descrizione-{{ $farmaco->ID_Farmaco }}" style="display: none;padding:15px;background-color: #f0efef;border-radius: 0.6em;border: 0.5px solid #808080;box-shadow: 0px 0px 4px rgb(157, 157, 157);">
                <h6>{{$farmaco->Descrizione}}</h6>
        </div>
   @endforeach
   @include('pagination.paginator', ['paginator' => $farmaci])

   <div class= "containerBottoniFaqs"  style="margin-top:70px">

        <div> 
            <button onclick="window.location.href='{{route('Amministratore')}}'" class="bottoneAdminFaq" type="button" style="background-color: #1A76D1;border-radius :0.4em;"> Indietro </button>                  
        </div>
        <div> <a href="{{route('FarmaciStorePage')}}"><button class="bottoneAdminFaq" style="background-color: #1A76D1;border-radius: 0.4em;">Aggiungi Farmaco</button></a></div>
    </div>
    



</div>



<script>
    // Aggiungi un evento di click a ciascun bottone
    document.querySelectorAll('.ciao').forEach(button => {
        button.addEventListener('click', function() {
                //ricava l'id del farmaco da data-id
            var farmacoId = this.getAttribute('data-id');
            /*la descrizione da descrizione-{$farmaco->ID_Farmaco} */
            var descrizioneDiv = document.getElementById('descrizione-' + farmacoId);

            // Toggle dello stato di visualizzazione della descrizione
            if (descrizioneDiv.style.display === 'none' || descrizioneDiv.style.display === '') {
                descrizioneDiv.style.display = 'block';
                this.textContent = '🔽';
            } else {
                descrizioneDiv.style.display = 'none';
                this.textContent = '▶️';
            }
        });
    });
</script>

@endsection