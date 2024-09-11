@php
    $price=$product->price;
    $price=$product->discounted?round(($price-($price*$product->discountPerc)/100), 2//valore che arrotonda alla seconnda cifra decimale
    ):$price;
@endphp

<p class="price"> {{ number_format($price, 2, ',', '.') }} € </p>

@if ($product->discounted)
<p class="discprice"> Valore <del>{{ number_format($product->price, 2, ',', '.') }} €</del><br>
    Sconto {{ $product->discountPerc }}%</p>
@endif
