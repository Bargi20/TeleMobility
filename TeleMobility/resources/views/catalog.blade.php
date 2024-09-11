@extends('layouts.user') <!--genera una vista che è un' estenzione della vista del layout quindi riusa sempre quella -->

@section('title', 'Catalogo Prodotti') <!--sezione sempre uguale perché è quello che vogliamo vedere nella sezione sopra la scheda catalogo prodotti -->

<!--pagina che genera la pagina dei prodotti -->

<!-- inizio sezione prodotti -->
<!-- template attivato per ogni azione che viene avviata dal controller -->
@section('content') <!--definisce la sezione -->
<div id="content">
    @isset($products)<!--quindi se ci sono prodotti da visualizzare li visualizzo senno tutto quello che viene dopo è vuoto
     direttiva blade, poiche che la sezione può anche non avere nessun contenuto e la zona a sfondo bianco va popolata
    solo quando il template di comando viene chiamato dal controller e visualizzato -->
      @foreach ($products as $product) <!--vado a scandire l'array associando ad ogni array un oggetto di oggetto 'product'-->
      <div class="prod">
          <div class="prod-bgtop">
              <div class="prod-bgbtm">
                  <div class="oneitem">
                      <div class="image">
                        @include('helpers/productImg', ['attrs' => 'imagefrm', 'imgFile' => $product->image]) <!--uso un helper perchè l'immagine dipende
                        se nel database ci sta o no un immagine quindi ci sta un processo di elaborazione che non codifico nella vista generica -->
                      </div>
                      <div class="info">
                          <h1 class="title">Prodotto: {{ $product->name }}</h1> <!--vado a prendere il nome del prodotto -->
                          <p class="meta">Descrizione Breve: {{ $product->descShort }}</p>
                      </div>
                      <div class="pricebox">
                        @include('helpers/productPrice') <!--il compito va ad un helpers che dovrà generare unaltra vista ancora complessa per quanto riguarda lo
                        sconto -->
                      </div>
                  </div>
                  <div class="entry">
                    <p>Descrizione Estesa: {!! $product->descLong !!}</p> <!--andiamo a prensentare la desc long che è una constante che sono state viste come tag
                    che se noi sanificazzimo il testo utilizzando la doppia graffa determinebbero la rappresentazione e quindi utilizziamo il meccanismo senza
                sanificazione che si attiva con !! dopo la graffa -->
                  </div>
              </div>
          </div>
      </div>
      @endforeach
    @endisset()
</div>

<!-- fine sezione prodotti -->

<div id="sidebar"> <!--sezione che sta a sinistra che viene modificata in base a quello che vogliamo vedere -->
    <ul>
        <li>
            <h2>Categorie</h2>
            <ul>
                @foreach ($topCategories as $category) <!--scandisce tutto l'array delle categorie top -->
                <li><a href="{{ route('catalog2', [$category->catId]) }}">{{ $category->name }}</a><span>{{ $category->desc }}</span></li>
                <!--crea un ancora che associa alla categoria una rotta chiamata catalog 2 che viene definita in base all'id della categoria del prodotto che
                stiamo raffiguarando quindi crea la rotta in base all'id delle categorie e viene generata a partire dalla struttura della rotta al quale aggiungo
                1 o 2 in base quello che gli do all'id -->
                @endforeach
            </ul>
        </li>

        @isset($selectedTopCat) <!--se siamo nella situazione che l'utente vuole vedere il prodotto parte questa sezione-->
        <li>
            <h2>In {{ $selectedTopCat->name }}</h2>
            <ul>
                @foreach ($subCategories as $subCategory)
                <li><a href="{{ route('catalog3', [$selectedTopCat->catId, $subCategory->catId]) }}">{{ $subCategory->name }}</a>
                    <span>
                        {{ $subCategory->desc }}
                    </span>
                </li>
                <!--generiamo la rotta che viene rapppresentata dall'id. All'interno delle ancore va messa anche la descrizione -->
                @endforeach
            </ul>
        </li>
        @endisset
    </ul>
</div>
<!-- fine sezione laterale -->
@endsection


