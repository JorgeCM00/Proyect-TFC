@extends('layouts.master')
@section('titulo')
Tienda
@endsection
@section('body')

<style>
        #cb-cookie-banner {
            z-index: 100;
            position: fixed;
            bottom: 2%;
            left: 25%;
            right: 25%;
        }
    </style>
<div id="cb-cookie-banner" class="alert alert-dark text-center mb-0" role="alert">
        🍪{{__('This site use cookies to improve the user experience.')}}
        <a href="https://www.cookiesandyou.com/" target="blank">{{__('Learn more')}}</a>
        <br />
        <br>
        <button type="button" class="btn btn-primary btn-sm ms-3" onclick="window.hideCookieBanner()">
            {{__('Accept all the cookies')}}
        </button>
    </div>
<div class="container">

    <?php if (isset($datosTienda[0])) {
    ?>


        @foreach($datosTienda as $tienda)
        <div class="col-12">
            <div class="container my-5 py-4 bg-light">
                <div class="row ">
                    <div class="col-12 col-lg-6 col-sm-12">
                        <img src="{{URL::asset('productos/'.$tienda->imagen)}}" class="img-fluid text-center " style="width: 400px; height: 300px; ">
                    </div>
                    <div class="col-12 col-lg-6 col-sm-12">
                        <div class=" text-center mt-2">
                            <h1 class="fw-bold mb-4 " style="word-wrap: break-word;">{{$tienda->nombre}}</h1>
                            <div class="mx-4">
                                <div class="fs-5 text-dark" style="word-wrap: break-word;">{!!$tienda->descripcion!!}</div>
                            </div>


                            <div class=" text-muted " style="word-wrap: break-word;">
                                <!-- Recoje las etiquetas del producto que fueron marcadas -->
                                @foreach($tienda->etiquetasProduto as $etiqueta)
                                @if($loop->first)
                                Etiquetas:
                                @endif

                                #{{ $etiqueta->nombreEtiqueta }}


                                @endforeach
                            </div>
                        </div>
                        <div class="row mt-5">

                            <div class="col-6 col-sm-12 col-lg-6 d-flex justify-content-end">
                                <input type="text" value="{{$tienda->precio}} €" class="text-center fs-5 input-group-text" readonly size="2%">
                            </div>
                            <div class="col-6 col-sm-12 col-lg-6">
                                <a class="btn btn-success  btn-block rounded-5 py-2" <?php  if (Auth::user()){?>onclick="alert('{{__('The product was added to your cart in `my site`')}}')"
                                    <?php } ?> href="/cesta/{{$tienda->id}}">{{__('Add to the cart')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="container my-4 py-5 px-5">
            <div class="col-12 col-lg-12 col-sm-12">
                <div class="row">
                    <div class=" d-flex justify-content-center">
                        {{$datosTienda->links()}}
                    </div>
                </div>
            </div>
        </div>

    <?php
    } else {
    ?>
        <div class="container my-5 py-5 px-5 bg-light shadow-sm">
            <div class="col-12 col-lg-12 col-sm-12">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 col-lg-6 col-sm-12">
                                <div class="d-flex justify-content-center">
                                    <h2><strong>{{__('No products have been created yet')}}</strong></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
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
@endsection
