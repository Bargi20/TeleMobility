@php
        if (empty($imgFile)) {
            $imgFile = 'default.jpg';
        }
@endphp
<img src="{{ asset('images/Dottori/' . $imgFile) }} ">
