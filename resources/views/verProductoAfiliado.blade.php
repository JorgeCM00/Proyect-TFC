@extends('layouts.master')
@section('titulo')
Tienda
@endsection
@section('body')
<div class="container">
    <div class="col-12 border"></div>
    <?php if (isset($productos[0])) {
    ?>
        @foreach($productos as $producto)

        <div class="container my-5 py-5 px-5 bg-light shadow-sm">
            <div class="col-12 col-lg-12 col-sm-12">
                <div class="row">
                    <div class="col-12">
                        <div class="row d-flex justify-content-center">
                            <div class="col-9 col-lg-6 col-sm-12">
                                    <img src="{{URL::asset('productos/'.$producto->imagen)}}" class="img-fluid " style="width: 400px; ">
                            </div>
                            <div class="col-9 col-lg-6 col-sm-12">
                                <div class="mx-4 text-center">
                                    <h1 class="fw-bold mb-4 ">{{$producto->nombre}}</h1>
                                    <div class="mx-4">
                                        <div class="fs-5 text-dark" style="word-wrap: break-word;">{!!$producto->descripcion!!}</div>
                                    </div>
                                    <div class=" text-muted ">
                                        <!--Recoje las etiquetas del producto que fueron marcadas-->
                                    @foreach($producto->etiquetasProduto as $etiqueta)
                                    
                                @if($loop->first)
                                Etiquetas:
                                @endif
                                    
                                 #{{ $etiqueta->nombreEtiqueta }} 
                                    
                                    
                                @endforeach
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-12 col-sm-12 mt-5 text-end">
                                    <a class="btn btn-success  btn-block rounded-5 py-2" href="/cesta/{{$producto->id}}">{{__('Add to the cart')}}</a>
                                </div>
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
                        {{$productos->links()}}
                    </div>
                </div>
            </div>
        </div>
</div>
<?php
    } else { ?>
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
@endsection