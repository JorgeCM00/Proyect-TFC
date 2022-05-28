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

    <style>
        #cb-cookie-banner {
            z-index: 100;
            position: fixed;
            bottom: 2%;
            left: 25%;
            right: 25%;
        }
    </style>
</head>

<script>
    /*
     * Javascript to show and hide cookie banner using localstorage
     */

    /**
     * @description Shows the cookie banner
     */
    function showCookieBanner() {
        let cookieBanner = document.getElementById("cb-cookie-banner");
        cookieBanner.style.display = "block";
        <?php
        $_SESSION['cookie_readed'] = "Yep!";
        ?>
    }

    /**
     * @description Hides the Cookie banner and saves the value to localstorage
     */
    function hideCookieBanner() {
        localStorage.setItem("cb_isCookieAccepted", "yes");

        let cookieBanner = document.getElementById("cb-cookie-banner");
        cookieBanner.style.display = "none";
    }

    /**
     * @description Checks the localstorage and shows Cookie banner based on it.
     */
    function initializeCookieBanner() {
        let isCookieAccepted = localStorage.getItem("cb_isCookieAccepted");
        if (isCookieAccepted === null) {
            localStorage.setItem("cb_isCookieAccepted", "no");
            showCookieBanner();
        }
        if (isCookieAccepted === "no") {
            showCookieBanner();
        }
    }

    // Assigning values to window object
    window.onload = initializeCookieBanner();
    window.cb_hideCookieBanner = hideCookieBanner;
</script>

<body class="bg-primary bg-opacity-25">
    <div id="cb-cookie-banner" class="alert alert-dark text-center mb-0" role="alert">
        🍪{{__('This site use cookies to improve the user experience.')}}
        <a href="https://www.cookiesandyou.com/" target="blank">{{__('Learn more')}}</a>
        <br />
        <br>
        <button type="button" class="btn btn-primary btn-sm ms-3" onclick="window.hideCookieBanner()">
            {{__('Accept all the cookies')}}
        </button>
    </div>
    @include('layouts.header')
    @include('layouts.menu')
    <div class="container-fluid">


        <div class="row">

        </div>

        <div class="row">
            @yield('body')
        </div>



        @include('layouts.footer')

    </div>
</body>

</html>