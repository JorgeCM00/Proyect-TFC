@extends('layouts.master')
@section('titulo')
GaliShop
@endsection
@section('body')
<div class="container my-5 py-5 px-5 ">
    <div class="col-6 col-lg-12 col-sm-6">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-8">
                        <div class="mx-5 justify-content-center">
                            <?php if (empty($datosTienda)) {
                            ?> <h2><strong>{{__('No products have been created yet')}}</strong></h2>
                            <?php
                            } ?>
                            @foreach($datosTienda as $tienda)
                            <div class="row my-2 ">
                            <ul>
                                <li> <a class=" fs-5 text-black" href="./gestionarProducto/{{$tienda->id}}">{{$tienda->nombre}}  <img class="mx-5 my-5" src="{{URL::asset('productos/'.$tienda->imagen)}}" class="img-fluid " style="width: 200px; height: 150px; "></a></li>
                            </ul>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection