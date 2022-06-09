<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{URL::asset('logo/favicon.ico')}}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}">
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />
    <title>GaliShop | @yield('titulo','Blog')</title>
    <!-- Da error pero funciona correctamente -->
    <style>
        .marker {
            background-image: url({{ asset('icono/indice.png')
        }
        }

        );
        background-size: cover;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        }
    </style>

    
</head>



<body class="bg-primary bg-opacity-25">
    
    @include('layouts.header')
    @include('layouts.menu')
    @yield('body')
    @include('layouts.footer')
    
</body>

</html>