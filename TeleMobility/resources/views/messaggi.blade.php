@extends('layouts.user')
@section('content')

@if($Lista_messaggi->isEmpty())
    @if($tipo == 'inviati')
        <div class="container" style="margin-top: 20px;">
        <div style="display: flex; justify-content: center;">
            <div class="container2" style="width: 70%; text-align: center;">
                <h3>Nessun messaggio inviato</h3>
                <div style="margin-top: 20px;">
                    @if($Utente->role == "Clinico")
                    <button onclick="window.location.href='{{route('home_messaggi')}}'" class="bottoneCartella1">Indietro</button>
                    @endif
                    @if($Utente->role == "Paziente")
                    <button onclick="window.location.href='{{route('home_messaggi_paziente')}}'" class="bottoneCartella1">Indietro</button>
                    @endif
                </div>
            </div>
        </div>
        </div>
    
        @endif
    @if($tipo == 'non_letti')
        <div class="container" style="margin-top: 20px;">
        <div style="display: flex; justify-content: center;">
            <div class="container2" style="width: 70%; text-align: center;">
                <h3>Nessun messaggio segnato come non letto</h3>
                <div style="margin-top: 20px;">
                    @if($Utente->role == "Clinico")
                    <button onclick="window.location.href='{{route('home_messaggi')}}'" class="bottoneCartella1">Indietro</button>
                    @endif
                    @if($Utente->role == "Paziente")
                    <button onclick="window.location.href='{{route('home_messaggi_paziente')}}'" class="bottoneCartella1">Indietro</button>
                    @endif
                </div>
            </div>
        </div>
        </div>
        @endif 
    @if($tipo == 'letti')
        <div class="container" style="margin-top: 20px;">
        <div style="display: flex; justify-content: center;">
            <div class="container2" style="width: 70%; text-align: center;">
                <h3>Nessun messaggio segnato come letto</h3>
                <div style="margin-top: 20px;">
                    @if($Utente->role == "Clinico")
                    <button onclick="window.location.href='{{route('home_messaggi')}}'" class="bottoneCartella1">Indietro</button>
                    @endif
                    @if($Utente->role == "Paziente")
                    <button onclick="window.location.href='{{route('home_messaggi_paziente')}}'" class="bottoneCartella1">Indietro</button>
                    @endif
                </div>
            </div>
        </div>
        </div>
        @endif







@else


@if($tipo == 'inviati')
    @if($Utente->role == "Clinico")
        <div class="container" style="margin-top: 20px;">
        <div style="display: flex;">
        <div class="container2" style="width: 70%;">
            @foreach ($Lista_messaggi as $messaggio)
            <div style="display: flex;">
                <div style="color: white; margin-bottom: 20px; width: 80%">
                    <h6> Inviato a {{$pazienti[$messaggio->id_destinatario] ?? 'Destinatario sconosciuto'}} alle {{$messaggio->orario}}</h6>
                    <div class="Domanda" >
                        <div class="rettangoloFaq" style="width: 100%;">
                            <h2 class="styledomande" style="margin: 0;">{{$messaggio->corpo}}</h2>
                        </div>
                    </div>
                    <!-- Start Answer -->
                    <div class="Risposta" style="border-radius: 0 0 20px 20px; ">
                        <p style="padding-bottom: 10px;">{{$messaggio->contenuto}}</p>
                    </div>
                    @if($messaggio->id_risposta != null)
                <div style="height: 5px"></div>
                <h6> Per rispondere al messaggio: <span class="arrow mostra-nascondi" style="cursor: pointer;"> ▶️ </span></h6>
                @foreach ($Domande as $messaggio_p)
                @if ($messaggio_p->id == $messaggio->id_risposta)
                <div style="transform: translateX(10px); transform: scale(0.9); margin-top: 5px; display: none;" >
                
                    

                    <div class="Domanda" >
                    <div class="rettangoloFaq" style="width: 100%;">
                        <h2 class="styledomande" style="margin: 0;">{{$messaggio_p->corpo}}</h2>
                    </div>
                </div>
                
                <!-- Start Answer -->
                <div class="Risposta" style="border-radius: 0 0 20px 20px; ">
                    <p style="padding-bottom: 10px;">{{$messaggio_p->contenuto}}</p>
                </div> 
                </div>
                    @endif
                    @endforeach
                    

                @endif
                </div>
                
                


                <div style="width: 20%; padding-left: 15px; padding-top:30px">
                    <form method="POST" action="{{route('elimina_mex', ['id' => $messaggio->id] ) }}">
                        @csrf
                        <a href="{{route('elimina_mex', ['id' => $messaggio->id] ) }}"><button class="listaPazientiBottone">Elimina</button></a>
                    </form> 
                
                </div>
            </div>

            @endforeach
            
        
            </div>
            
       

        <div style="width: 30%; border-left: 1px solid black; padding-left: 15px;">
            <h4>Filtra destinatario messaggi:</h4>
            <div style="padding-top: 20px;"></div>
            @foreach ($Lista_pazienti as $paziente)
                <div class="paziente-container" style="margin-bottom: 10px;">
                    <span>{{$pazienti[$paziente->id]}}</span>
                
                        <button onclick="window.location.href='{{route('visualizza_messaggi_filtrata',['p' => $paziente->id])}}'" class="listaPazientiBottone">Filtra</button>
                        
                    
                </div>
            @endforeach
        </div>
            
   
        </div>
        @if(@isset($filtro))
    
        <div style="margin-top:20px;margin-left:15px"><button onclick="window.location.href='{{route('visualizza_messaggi',1)}}'" class="bottoneCartella1"> Indietro </button></div>

    
        @else
        <div style="margin-top:20px;margin-left:15px"><button onclick="window.location.href='{{route('home_messaggi')}}'" class="bottoneCartella1"> Indietro </button></div>

        
        @endisset

        @if(session('success'))
        <div class="alert alert-success" style="margin-top: 1%">
            {{ session('success') }}
        </div>
        @endif

        </div>
        @endif



    @if($Utente->role == "Paziente")
        <div class="container" style="margin-top: 20px;">
        <div style="display: flex;">
         <div class="container2" style="width: 70%;">
            @foreach ($Lista_messaggi as $messaggio)
            <div style="display: flex;">
                <div style="color: white; margin-bottom: 20px; width: 80%">
                    <h6> Inviato alle {{$messaggio->orario}}</h6>
                    <div class="Domanda" >
                        <div class="rettangoloFaq" style="width: 100%;">
                            <h2 class="styledomande" style="margin: 0;">{{$messaggio->corpo}}</h2>
                        </div>
                    </div>
                    <!-- Start Answer -->
                    <div class="Risposta" style="border-radius: 0 0 20px 20px; ">
                        <p style="padding-bottom: 10px;">{{$messaggio->contenuto}}</p>
                    </div>
                    @if($messaggio->id_risposta != null)
                <div style="height: 5px"></div>
                <h6> Per rispondere al messaggio: <span class="arrow mostra-nascondi" style="cursor: pointer;"> ▶️ </span></h6>
                @foreach ($Domande as $messaggio_p)
                @if ($messaggio_p->id == $messaggio->id_risposta)
                <div style="transform: translateX(10px); transform: scale(0.9); margin-top: 5px; display: none;" >
                
                    

                    <div class="Domanda" >
                    <div class="rettangoloFaq" style="width: 100%;">
                        <h2 class="styledomande" style="margin: 0;">{{$messaggio_p->corpo}}</h2>
                    </div>
                </div>
                
                <!-- Start Answer -->
                <div class="Risposta" style="border-radius: 0 0 20px 20px; ">
                    <p style="padding-bottom: 10px;">{{$messaggio_p->contenuto}}</p>
                </div> 
                </div>
                    @endif
                    @endforeach
                    

                @endif
                
                </div>
                <div style="width: 20%; padding-left: 15px; padding-top:30px">
                    <form method="POST" action="{{route('elimina_mex', ['id' => $messaggio->id] ) }}">
                        @csrf
                        <a href="{{route('elimina_mex', ['id' => $messaggio->id] ) }}"><button class="listaPazientiBottone">Elimina</button></a>
                    </form> 
                
                </div>
            </div>
                    @endforeach
                </div>
           
        

        
        <div style="width: 30%; "></div>
        </div>
        <div style="margin-top:20px;margin-left:15px"><button onclick="window.location.href='{{route('home_messaggi_paziente')}}'" class="bottoneCartella1"> Indietro </button></div>

        @if(session('success'))
        <div class="alert alert-success" style="margin-top: 1%">
            {{ session('success') }}
        </div>
        @endif

        </div>

        @endif
@endif

<!----------------------------------->


@if($tipo == 'non_letti')
    @if($Utente->role == "Clinico")
        <div class="container" style="margin-top: 20px;">
        <div style="display: flex;">
        <div class="container2" style="width: 70%">
            @foreach ($Lista_messaggi as $messaggio)
            <div style="display: flex;">
                <div style="color: white; margin-bottom: 30px; width: 80%;">
                    <h6> Inviato da {{$pazienti[$messaggio->id_mittente] ?? 'Destinatario sconosciuto'}} alle {{$messaggio->orario}}</h6>
                    <div class="Domanda" >
                        <div class="rettangoloFaq" style="width: 100%;">
                            <h2 class="styledomande" style="margin: 0;">{{$messaggio->corpo}}</h2>
                        </div>
                    </div>
                    <!-- Start Answer -->
                    <div class="Risposta" style="border-radius: 0 0 20px 20px; ">
                        <p style="padding-bottom: 10px;">{{$messaggio->contenuto}}</p>
                    </div>
                    @if($messaggio->id_risposta != null)
                    <div style="height: 5px"></div>
                    <h6> In risposta al tuo messaggio: <span class="arrow mostra-nascondi" style="cursor: pointer;"> ▶️ </span></h6>
                    @foreach ($Messaggi_prec as $messaggio_p)
                    @if ($messaggio_p->id == $messaggio->id_risposta)
                    <div style="transform: translateX(10px); transform: scale(0.9); margin-top: 5px; display: none;" >
                    
                        

                        <div class="Domanda" >
                        <div class="rettangoloFaq" style="width: 100%;">
                            <h2 class="styledomande" style="margin: 0;">{{$messaggio_p->corpo}}</h2>
                        </div>
                    </div>
                    
                    <!-- Start Answer -->
                    <div class="Risposta" style="border-radius: 0 0 20px 20px; ">
                        <p style="padding-bottom: 10px;">{{$messaggio_p->contenuto}}</p>
                    </div> 
                    </div>
                        @endif
                        @endforeach
                        

                    @endif
                </div>
                <div style="width: 20%; padding-left: 15px; padding-top:15px">
            
                    <form method="POST" action="{{route('segna_letto', ['id' => $messaggio->id] ) }}">
                        @csrf
                        <a href="{{route('segna_letto', ['id' => $messaggio->id] ) }}"><button class="listaPazientiBottone">Letto</button></a>
                    </form> 
                    
                    <div style="height: 10px"></div>
                    <form method="GET" action="{{route('risposta_dottore', ['risposta' => $messaggio->id] ) }}">
                        @csrf
                        <a href="{{route('risposta_dottore', ['risposta' => $messaggio->id])}}"><button class="listaPazientiBottone">Rispondi</button></a>
                    </form> 
                
                </div></div>
            @endforeach
            
        </div>
        
        <div style="width: 30%; border-left: 1px solid black; padding-left: 15px;">
            <h4>Filtra mittente messaggi:</h4>
            <div style="padding-top: 20px;"></div>
            @foreach ($Lista_pazienti as $paziente)
                <div class="paziente-container" style="margin-bottom: 10px;">
                    <span>{{$pazienti[$paziente->id]}}</span>
                
                        <button onclick="window.location.href='{{route('visualizza_messaggi_non_letti_filtrata',['p' => $paziente->id])}}'" class="listaPazientiBottone">Filtra</button>
                        
                    
                </div>
            @endforeach
        </div> 
        
        </div>
        @if(@isset($filtro))
    
        <div style="margin-top:20px;margin-left:15px"><button onclick="window.location.href='{{route('visualizza_messaggi',2)}}'" class="bottoneCartella1"> Indietro </button></div>


        @else
        <div style="margin-top:20px;margin-left:15px"><button onclick="window.location.href='{{route('home_messaggi')}}'" class="bottoneCartella1"> Indietro </button></div>
        @endif
             @if(session('success'))
             <div class="alert alert-success" style="margin-top: 1%">
            {{ session('success') }}
                </div>
            @endif
        </div>
        @endif



    @if($Utente->role == "Paziente")
        <div class="container" style="margin-top: 20px;">
        <div style="display: flex;">
        <div class="container2" style="width: 70%">
            @foreach ($Lista_messaggi as $messaggio)
            <div style="display: flex;">
                <div style="color: white; margin-bottom: 30px; width: 80%;">
                    <h6> Inviato alle {{$messaggio->orario}} </h6>
                    <div class="Domanda" >
                        <div class="rettangoloFaq" style="width: 100%;">
                            <h2 class="styledomande" style="margin: 0;">{{$messaggio->corpo}}</h2>
                        </div>
                    </div>
                    <!-- Start Answer -->
                    <div class="Risposta" style="border-radius: 0 0 20px 20px; ">
                        <p style="padding-bottom: 10px;">{{$messaggio->contenuto}}</p>
                    </div>
                    @if($messaggio->id_risposta != null)
                    <div style="height: 5px"></div>
                    <h6> In risposta al tuo messaggio: <span class="arrow mostra-nascondi" style="cursor: pointer;"> ▶️ </span></h6>
                    @foreach ($Messaggi_prec as $messaggio_p)
                    @if ($messaggio_p->id == $messaggio->id_risposta)
                    <div style="transform: translateX(10px); transform: scale(0.9); margin-top: 5px; display: none;" >
                    
                        

                        <div class="Domanda" >
                        <div class="rettangoloFaq" style="width: 100%;">
                            <h2 class="styledomande" style="margin: 0;">{{$messaggio_p->corpo}}</h2>
                        </div>
                    </div>
                    
                    <!-- Start Answer -->
                    <div class="Risposta" style="border-radius: 0 0 20px 20px; ">
                        <p style="padding-bottom: 10px;">{{$messaggio_p->contenuto}}</p>
                    </div> 
                    </div>
                        @endif
                        @endforeach
                        

                    @endif


                </div>
                <div style="width: 20%; padding-left: 15px; padding-top:15px">
                    <form method="POST" action="{{route('segna_letto', ['id' => $messaggio->id] ) }}">
                        @csrf
                        <a href="{{route('segna_letto', ['id' => $messaggio->id] ) }}"><button class="listaPazientiBottone">Letto</button></a>
                    </form> 
                    
                    <div style="height: 10px"></div>
                    <form method="GET" action="{{route('risposta_paziente', ['risposta' => $messaggio->id] ) }}">
                        @csrf
                        <a href="{{route('risposta_paziente', ['risposta' => $messaggio->id])}}"><button class="listaPazientiBottone">Rispondi</button></a>
                    </form> 
                
                </div>
            </div>
            @endforeach
            
        </div>
        
       
        <div style="width: 30%; "></div>
        </div>
    
        <div style="margin-top:20px;margin-left:15px"><button onclick="window.location.href='{{route('home_messaggi_paziente')}}'" class="bottoneCartella1"> Indietro </button></div>

        @if(session('success'))
        <div class="alert alert-success" style="margin-top: 1%">
            {{ session('success') }}
        </div>
        @endif
        </div>
        @endif
@endif

<!------------>

@if($tipo == 'letti')
    @if($Utente->role == "Clinico")
        <div class="container" style="margin-top: 20px;">
        <div style="display: flex;">
        <div class="container2" style="width: 70%">
            @foreach ($Lista_messaggi as $messaggio)
            <div style="display: flex;">
                <div style="color: white; margin-bottom: 30px; width: 80%;">
                    <h6> Inviato da {{$pazienti[$messaggio->id_mittente] ?? 'Destinatario sconosciuto'}} alle {{$messaggio->orario}}</h6>
                    <div class="Domanda" >
                        <div class="rettangoloFaq" style="width: 100%;">
                            <h2 class="styledomande" style="margin: 0;">{{$messaggio->corpo}}</h2>
                        </div>
                    </div>
                    <!-- Start Answer -->
                    <div class="Risposta" style="border-radius: 0 0 20px 20px; ">
                        <p style="padding-bottom: 10px;">{{$messaggio->contenuto}}</p>
                    </div>
                    @if($messaggio->id_risposta != null)
                    <div style="height: 5px"></div>
                    <h6> In risposta al tuo messaggio: <span class="arrow mostra-nascondi" style="cursor: pointer;"> ▶️ </span></h6>
                    @foreach ($Messaggi_prec as $messaggio_p)
                    @if ($messaggio_p->id == $messaggio->id_risposta)
                    <div style="transform: translateX(10px); transform: scale(0.9); margin-top: 5px; display: none;" >
                    
                        

                        <div class="Domanda" >
                        <div class="rettangoloFaq" style="width: 100%;">
                            <h2 class="styledomande" style="margin: 0;">{{$messaggio_p->corpo}}</h2>
                        </div>
                    </div>
                    
                    <!-- Start Answer -->
                    <div class="Risposta" style="border-radius: 0 0 20px 20px; ">
                        <p style="padding-bottom: 10px;">{{$messaggio_p->contenuto}}</p>
                    </div> 
                    </div>
                        @endif
                        @endforeach
                        

                    @endif
                </div>
                <div style="width: 20%; padding-left: 15px; padding-top:30px">
                    <form method="GET" action="{{route('risposta_dottore', ['risposta' => $messaggio->id] ) }}">
                        @csrf
                        <a href="{{route('risposta_dottore', ['risposta' => $messaggio->id])}}"><button class="listaPazientiBottone">Rispondi</button></a>
                    </form>
                </div></div>
            @endforeach
            
        </div>
        
        <div style="width: 30%; border-left: 1px solid black; padding-left: 15px;">
            <h4>Filtra mittente messaggi:</h4>
            <div style="padding-top: 20px;"></div>
            @foreach ($Lista_pazienti as $paziente)
                <div class="paziente-container" style="margin-bottom: 10px;">
                    <span>{{$pazienti[$paziente->id]}}</span>
                
                        <button onclick="window.location.href='{{route('visualizza_messaggi_letti_filtrata',['p' => $paziente->id])}}'" class="listaPazientiBottone">Filtra</button>
                        
                    
                </div>
            @endforeach
        </div> 
        
        </div>
        @if(@isset($filtro))
    
        <div style="margin-top:20px;margin-left:15px"><button onclick="window.location.href='{{route('visualizza_messaggi',3)}}'" class="bottoneCartella1"> Indietro </button></div>


        @else
        <div style="margin-top:20px;margin-left:15px"><button onclick="window.location.href='{{route('home_messaggi')}}'" class="bottoneCartella1"> Indietro </button></div>
        @endif
        @if(session('success'))
        <div class="alert alert-success" style="margin-top: 1%">
            {{ session('success') }}
        </div>
        @endif
        </div>
        @endif


    @if($Utente->role == "Paziente")
        <div class="container" style="margin-top: 20px;">
        <div style="display: flex;">
        <div class="container2" style="width: 70%">
            @foreach ($Lista_messaggi as $messaggio)
            <div style="display: flex;">
                <div style="color: white; margin-bottom: 30px; width: 80%;">
                    <h6> Inviato alle {{$messaggio->orario}}</h6>
                    <div class="Domanda" >
                        <div class="rettangoloFaq" style="width: 100%;">
                            <h2 class="styledomande" style="margin: 0;">{{$messaggio->corpo}}</h2>
                        </div>
                    </div>
                    <!-- Start Answer -->
                    <div class="Risposta" style="border-radius: 0 0 20px 20px; ">
                        <p style="padding-bottom: 10px;">{{$messaggio->contenuto}}</p>
                    </div>
                    @if($messaggio->id_risposta != null)
                    <div style="height: 5px"></div>
                    <h6> In risposta al tuo messaggio: <span class="arrow mostra-nascondi" style="cursor: pointer;"> ▶️ </span></h6>
                    @foreach ($Messaggi_prec as $messaggio_p)
                    @if ($messaggio_p->id == $messaggio->id_risposta)
                    <div style="transform: translateX(10px); transform: scale(0.9); margin-top: 5px; display: none;" >
                    
                        

                        <div class="Domanda" >
                        <div class="rettangoloFaq" style="width: 100%;">
                            <h2 class="styledomande" style="margin: 0;">{{$messaggio_p->corpo}}</h2>
                        </div>
                    </div>
                    
                    <!-- Start Answer -->
                    <div class="Risposta" style="border-radius: 0 0 20px 20px; ">
                        <p style="padding-bottom: 10px;">{{$messaggio_p->contenuto}}</p>
                    </div> 
                    </div>
                        @endif
                        @endforeach
                        

                    @endif


                </div>
                <div style="width: 20%; padding-left: 15px; padding-top:30px">
                    <form method="GET" action="{{route('risposta_paziente', ['risposta' => $messaggio->id] ) }}">
                        @csrf
                        <a href="{{route('risposta_paziente', ['risposta' => $messaggio->id])}}"><button class="listaPazientiBottone">Rispondi</button></a>
                    </form> 
                
                </div></div>
            @endforeach
            
        </div>
        
       
        <div style="width: 30%; "></div>
        </div>
        <div style="margin-top:20px;margin-left:15px"><button onclick="window.location.href='{{route('home_messaggi_paziente')}}'" class="bottoneCartella1"> Indietro </button></div>

        @if(session('success'))
        <div class="alert alert-success" style="margin-top: 1%">
            {{ session('success') }}
        </div>
        @endif
        </div>
        @endif

@endif



@endif
@endsection
