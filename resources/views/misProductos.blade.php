@extends('layouts.master')
@section('titulo')
GaliShop
@endsection
@section('body')
<div class="container my-5 py-5 px-5 bg-light shadow-sm">
    <div class="col-12 col-lg-12 col-sm-12">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6 col-lg-6 col-sm-12">
                        <div class="mx-5 justify-content-center">
                            <?php if (empty($datosTienda)) {
                            ?> <h2><strong>{{__('No products have been created yet')}}</strong></h2>
                            <?php
                            } ?>
                            @foreach($datosTienda as $tienda)

                            <ul>
                                <li> <a class=" fs-4 text-black" href="./gestionarProducto/{{$tienda->id}}">{{$tienda->nombre}} <img src="{{URL::asset('productos/'.$tienda->imagen)}}" class="img-fluid " style="max-width: 60px; "></a></li>
                            </ul>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection