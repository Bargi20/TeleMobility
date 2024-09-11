@extends('layouts.user')

@section('content')

<div class="container">
    <div class="container2">
        <form>
            @csrf
            <label for="search">Cerca Clinico:</label>
            <input type="text" id="search" name="search">
        </form>
        <div style="padding-bottom:10px; margin-top: 2em">
            <h3 style="text-align: left; color: black;">Lista Dottori: </h3>
        </div>
        <div id="container">
            @foreach ($Dottori as $dottore)
            <a href="{{ route('ClinicoSel',intval($dottore->id)) }}">
                <div class="rettangoloClinAdmin" style="margin-bottom: 0%">
                    <h3 style="padding-left: 20px"> {{$dottore -> name}} {{$dottore -> surname}}</h3>
                </div>
            </a>
            @endforeach
        </div>
        <div>
            <div style="padding-top: 50px"></div>
            <a href="{{ route('Amministratore') }}"><button class="bottoneCartella1">Indietro</button></a>

            <a href="{{route('InserisciClinico') }}"><button class="bottoneCartella1">Inserisci Clinico</button></a>
        </div>
    </div>


    <div class="container">@include('pagination.paginator', ['paginator' => $Dottori])</div>
    @if(session('success'))
    <div class="alert alert-success" style="margin-top: 1%">
        {{ session('success') }}
    </div>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();

            $.ajax({
                url: '{{ route('search-clinico') }}',
                type: 'GET',
                data: {'query': query},
                success: function(data) {
                    $('#container').empty();
                    if (data.length > 0) {
                        data.forEach(function(clinico) {
                            var clinicoHTML = `
                                <a href="{{ route('ClinicoSel', ':id') }}">
                                    <div class="rettangoloClinAdmin" style="margin-bottom: 0%">
                                        <h3 style="padding-left: 20px">${clinico.name} ${clinico.surname}</h3>
                                    </div>
                                </a>
                            `;
                            clinicoHTML = clinicoHTML.replace(':id', clinico.id); 
                            $('#container').append(clinicoHTML); 
                        });
                    } else {
                        $('#container').html('<p>Nessun clinico trovato.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Errore:', status, error);
                }
            });
        });
    });
</script>
@endsection
