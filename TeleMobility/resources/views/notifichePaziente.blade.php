@extends('layouts.user')

@section('content')
<div class="container mt-4">
    <h1>Notifiche</h1>
    <div class="list-group" style="padding-top:25px;">
        @foreach ($Notifiche_n as $Notifica)
            <div class="list-group-item" style="background-color: #ff9b9b;">
                <div class="d-flex w-100 justify-content-between">
                    <h5 style="margin-bottom: 1em;">Notifica</h5>
                    <small>{{ $Notifica->DataNotifica }} {{ $Notifica->Orario }}</small>
                </div>
                <p class="mb-1">Messaggio: {{ $Notifica->Messaggio }}</p>
            </div>
        @endforeach
    </div>
    <div class="list-group" style="padding-top:15px">
        @foreach ($Notifiche_v as $Notifica)
            <div class="list-group-item">
                <div class="d-flex w-100 justify-content-between">
                    <h5 style="margin-bottom: 1em;">Notifica</h5>
                    <small>{{ $Notifica->DataNotifica }} {{ $Notifica->Orario }}</small>
                </div>
                <p class="mb-1">Messaggio: {{ $Notifica->Messaggio }}</p>
            </div>
        @endforeach
    </div>
</div>
<div class="container">@include('pagination.paginator', ['paginator' => $Notifiche_v])</div>
@endsection