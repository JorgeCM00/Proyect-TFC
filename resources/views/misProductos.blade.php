@extends('layouts.master')
@section('titulo')
GaliShop
@endsection
@section('body')
<div class="container mt-5 my-5">
    <div class="row d-flex justify-content-center">
        @foreach($datosTienda as $tienda)
        <div class="col-12 col-lg-4 col-sm-12">
            <div class="bg-light rounded  text-center m-4 border-0 " >
                <a href="./gestionarProducto/{{$tienda->id}}"> <img class="card-img-top rounded" src="{{URL::asset('productos/'.$tienda->imagen)}}" style="height:16rem"></a>
                <div class="card-body">
                    <a class="text-decoration-none card-title fs-5 text-black" href="./gestionarProducto/{{$tienda->id}}">{{$tienda->nombre}}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<?php if (empty($datosTienda)) {
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
@endsection
