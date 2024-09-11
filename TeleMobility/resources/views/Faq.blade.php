@extends('layouts.user')

@section('content')
@isset($faq)

<!-- Inizio Faq-->
<div style="display: flex; padding-bottom: 2%;padding-top: 2%;">
	<div style="max-width: 50%;">
			@foreach ($faq as $elemento)
			@if( $elemento -> Id_Faq % 2 != 0) 
        <div class="containerFaq" style="padding-top: 5px;">
            <div style="color: white;">
                <div class="Domanda">
                    <div class="rettangoloFaq" style="width: 100%;">
                        <h2 class= "styledomande" > {{$elemento -> Domanda }}</h2>
                    </div>
            	</div>
        <!--Start Answer-->
                <div class="Risposta">
                     <p>{{$elemento -> Risposta }}</p>
				</div>
			</div>
    	</div>
		@endif
		@endforeach
	</div>

<div style="max-width: 50%;">
@foreach ($faq as $elemento)
@if( $elemento -> Id_Faq  % 2 == 0) 
	<div class="containerFaq " style="padding-top: 5px;"">
		<div style="color: white;">
			<div class="Domanda">
				<div class="rettangoloFaq" style="width: 100%;">
					<h2 class= "styledomande" >{{$elemento -> Domanda }}</h2>
				</div>
			</div>
			<div class="Risposta">
					 <p>{{$elemento -> Risposta }}</p>
			</div>
		</div>
	</div>
@endif
@endforeach
</div>
</div>
@endisset()
@endsection
