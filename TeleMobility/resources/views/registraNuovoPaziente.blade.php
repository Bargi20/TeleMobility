@extends('layouts.user')
@section('content')


<div class="container">
    <div class="container2" >
    <div style="padding-top: 1%">
        <h3>Inserisci Dati </h3><br>
    </div>
    {{ html()->form('POST', route('paziente.store'))->acceptsFiles()->open() }}
        <div style="background-color: #0000; display: flex ;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Nome:</h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%; " >
            {{ html()->text('name')->id('current')}}

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
                {{ html()->text('surname')->id('current')}}
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
    
                {{ html()->date('DataDiNascita')->attribute('min', '1940-01-01')->attribute('max', date('Y-m-d')) }}
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
            {{ html()->text('Indirizzo')->id('current')}}

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
            {{ html()->text('Telefono')->id('current')}}
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
            {{ html()->text('email')->id('current')}}
                
            </div>
        </div>


        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Genere: </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%;" >
          {{ html()->text('Genere')->id('current')}}
 
            </div>
        </div>

        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Username: </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%;" >
            {{ html()->text('username')->id('current')}}
            </div>
        </div> 
        <div style="background-color: #0000; display: flex ; padding-top: 1%;" >
            <div style="width: 15%; float: left; " >
                <h6 class="doctor-title" style="text-align: right; color: black;
                padding-left: 4%;">Password:  </h6>
            </div>
            <div style="width: 5%;" >
            </div>
            <div style="width: 30%;" >
            {{ html()->text('password')->id('current')}}

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
       


        </div>
   
    <button type="button" class="bottone" style="background-color: #1A76D1; color: #ffffff" onclick="resetForm()">
    Azzera
    </button>

    
    <button type="submit" class="bottoneSalva" style="background-color: #1A76D1; color: #ffffff">Salva</button>
    </form>
    {{ html()->form()->close() }}

    <div style="margin-top:0.5%">
        <button onclick="window.location.href='{{route('Clinico')}}'" class="bottoneCartella1"> Indietro </button>
    </div>

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




