@extends('layouts.user')
@section('content')




<div class="container">
    <div class="container2" >
    <div style="padding-top: 1%">
        <h3>Modifica Dati </h3><br>
    </div>
    {{ html()->form('POST', route('Dati_salvati',$clinico->id))->acceptsFiles()->open() }}
        <div style="background-color: #0000; display: flex ;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Nome:</h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%; " >
            {{ html()->text('name')->value($clinico->name)->id('current')}}

            </div>
        </div>


            <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Cognome</h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%;" >
                {{ html()->text('surname')->value($clinico->surname)->id('current')}}



            </div>
        </div>
        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Username:  </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%;" >
            {{ html()->text('username')->value($clinico->username)->id('current')}}

            </div>
        </div>
        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Data di Nascita:  </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%;" >
                {{ html()->date('DataDiNascita')->attribute('min', '1940-01-01')->attribute('max', date('Y-m-d'))->value(Auth::user()->DataDiNascita)->id('current') }}
            </div>
        </div>


        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Indirizzo: </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%;" >
            {{ html()->text('Indirizzo')->value($clinico->Indirizzo)->id('current')}}


            </div>
        </div>

        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Telefono: </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%;" >
            {{ html()->text('Telefono')->value($clinico->Telefono)->id('current')}}


            </div>
        </div>


        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Email:  </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%;" >
            {{ html()->text('email')->value($clinico->email)->id('current')}}
 
             
            </div>
            </div>


            <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
                <div style="width: 15%; float: left; " >
                    <h6 class="doctor-title" style="text-align: right; color: black;
                    padding-left: 4%;">Genere: </h6>
                </div>
                <div style="width: 5%;" ></div>
                <div style="width: 30%;" >
                {{ html()->text('Genere')->value($clinico->Genere)->id('current')}}

                </div>
            
            </div>
            <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
                <div style="width: 15%; float: left; " >
                    <h6 class="doctor-title" style="text-align: right; color: black;
                    padding-left: 4%;">Ruolo: </h6>
                </div>
                <div style="width: 5%;" ></div>
                <div style="width: 30%;" >
                {{ html()->text('Ruolo')->value($clinico->Ruolo_Clinico)->id('current')}}

                </div>
            
            </div>
            <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
                <div style="width: 15%; float: left; " >
                    <h6 class="doctor-title" style="text-align: right; color: black;
                    padding-left: 4%;">Specializzazione: </h6>
                </div>
                <div style="width: 5%;" ></div>
                <div style="width: 30%;" >
                {{ html()->text('Specializzazione')->value($clinico->Specializzazione)->id('current')}}

                </div>
            
            </div>


            <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
                <div style="width: 15%; float: left; " >
                    <h6 class="doctor-title" style="text-align: right; color: black;
                    padding-left: 4%;">Descrizione: </h6>
                </div>
                <div style="width: 5%;" ></div>
                <div style="width: 30%;" >
                {{ html()->textArea('Descrizione')->value($clinico->Descrizione)->id('current')}}

                </div>
            
            </div>
        
          <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left;">
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Immagine:  </h6>
            </div>
            <div style="width: 5%;">
            </div>
            <div style="width: 30%;">
            {{ html()->file('Immagine')->id('current')}}
            </div>
        </div>
        <div style="background-color: #0000; display: flex; padding-top: 1%;">
            <div style="width: 15%; float: left;">
                <h6 class="doctor-title" style="text-align: right; color: black; padding-left: 4%;">Rimuovi Immagine: </h6>
            </div>
            <div style="width: 5%;"></div>
            <div style="width: 30%;">
                <input type="checkbox" name="elimina_foto" value="1">
                <label>Sì</label>
            </div>
            
        </div>
       
        </div>

        <button type="button" class="bottone" style="background-color: #1A76D1; color: #ffffff;" onclick="window.location.href='{{ route('ClinicoSel', $clinico->id) }}'">
            Indietro
        </button>
        
        
   
    <button type="button" class="bottone" style="background-color: #1A76D1; color: #ffffff" onclick="resetForm()">
    Azzera
    </button>

    
    <button type="submit" class="bottoneSalva" style="background-color: #1A76D1; color: #ffffff">Salva</button>
    </form>
    {{ html()->form()->close() }}
    <a href="{{route('Modifica_Admin_Clinico_admin', ['id' => $clinico->id]) }}"> <button  class="bottone" style="background-color: #1A76D1;color: #ffffff">Ricomincia</button></a>


    @if ($errors->any())
    <div class="alert alert-danger" style="margin-top: 1%">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif



</div>
</div>


<script>
   function resetForm()  {
    var currentElements = document.querySelectorAll("[id=current]");
    currentElements.forEach(function(element) {
        element.value = "";
    });
}


   

</script>



@endsection

