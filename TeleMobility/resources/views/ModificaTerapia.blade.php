

@extends('layouts.user')

@section('content')

@if($paziente)

<div class="container"  style="display:flex;">


    <div class="container2" style="margin-right:25px  margin-right: 25px; min-width: 150px;
  
    padding-top: 10px; padding-bottom: 10px;">
        
        <div style="padding-bottom:10px;margin-top:20px; ">
            <h6 style="text-align: left; color: black;">Terapia Attuale: </h6>
        </div>

        @if ($paziente->Terapia ==  "///" or $paziente->Terapia ==  "")
        <div style="width: 30%;">
            <h6 class="doctor-title" style="text-align: center; color: black; padding-left: 4%; border: 1px solid black;">Non Presente</h6>
        </div>
        @else
        <div style="width: 100%; border: 1px solid black;">
            <h6 class="doctor-title" style=" text-align: left; color: black; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; padding-right: 1%; font-size: 15px;">
                {!! nl2br(e($paziente->Terapia)) !!}
            </h6>
        </div>
        @endif 



        <div style="padding-top: 35px;">
            <div>
                {{ html()->form('POST', route('modificaterapia', $paziente->id))->acceptsFiles()->open() }}

                


                <h6 style="color: black;margin-bottom:15px">Nuova Terapia:</h6>
            </div>

            <div>
                <textarea  name="terapia" id="terapia" style="width: 100%; border: 1px solid black;height: 200px; padding: 10px; font-size: 14px;color:black"></textarea>
            </div>
            
        </div>
    

        <div>
            <div style="padding-top: 30px"></div>    
            <button type="submit" class="bottoneSalva" style="background-color: #1A76D1; color: #ffffff; ">Salva Terapia</button>
            
        </div>

        <button type="button" class="bottoneCartella1" style="margin-top: 1em" onclick="window.location.href='{{ route('PazienteSelezionato', $paziente->id) }}'">Indietro</button>

    
    </div>



    <div class="linea-verticale"></div>


    <div style="margin-left:20px; margin-top:40px;display:flex; flex-direction:column">

        <div style="margin-bottom:40px;color:black;font-size:15px; padding:5px;background-color: #f0efef;box-shadow: 0px 0px 3px rgb(157, 157, 157);">
            Qui puoi prescrivere una terapia selezionando <span style="color:#1A76D1">
                i farmaci e le attività riabilitative </span>direttamente dal catalogo
        </div>

        <h5>Seleziona i farmaci: </h5>
        <div style="margin-bottom:20px;margin-top:15px; padding:7px; max-height: 150px; overflow-y: auto; border: 1px solid black">
            <div>
                @foreach ($farmaci as $farmaco)
                    <div>
                        <input type="checkbox" name="farmaci[]" value="{{$farmaco->ID_Farmaco}}" > {{$farmaco->Nome_Farmaco}}
                    </div>
                @endforeach
            </div>
        </div>

        <h5>Seleziona le attività: </h5>
        <div style="margin-bottom:20px;margin-top:15px; padding:7px; max-height: 150px; overflow-y: auto; border: 1px solid black">
            <div>
                @foreach($attività as $elemento)
                    <div>
                        <input type="checkbox" name="attivita[]"  value="{{$elemento->Id_Attività_Riabilitative }}"> {{$elemento->Nome_Attività}}
                    </div>
                @endforeach
            </div>
        </div>
        {{ html()->form()->close() }}
    </div>
</div>

@endif
@endsection

