@extends('layouts.master')
@section('titulo')
Afiliados
@endsection
@section('body')
<div class="container">
    <div class="col-12 border"></div>
    @foreach($datos as $afiliado)
    <div class="container my-5 py-5 px-5 bg-light shadow-sm">
        <div class="col-12 col-lg-12 col-sm-12">
            <div class="row">
                <div class="col-12">
                    <div class="row d-flex justify-content-center">
                        <div class="col-9 col-lg-4 col-sm-12">
                            <div class="d-flex justify-content-center">
                                <?php

                                if (isset($afiliado->foto)) { //Si no hay imagen pone una por defecto
                                ?> <img src="{{URL::asset('imagenes/'.$afiliado->user_id.'.jpeg')}}" class="img-fluid rounded-circle p-3 " style="width: 400px; height:300px ">
                                <?php
                                } else { ?>
                                    <img class="img-fluid rounded-circle p-3 " style="width: 300px;" src="{{URL::asset('imagenes/images.png')}}" alt="Foto de perfil">
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                        <div class="col-9 col-lg-8 col-sm-12">
                            <div class="mx-4 text-center">
                                <h1 class="fw-bold mb-4 text-primary">{{$afiliado->nombreEmpresa}}</h1>
                                <div class="mx-4">
                                    <div class="fs-5 text-dark" style="word-wrap: break-word;">{{$afiliado->descripcion}}</div>
                                </div>
                                <div class="col-12 col-lg-12 col-sm-12 mt-5 ">
                        <div class="row">
                        

                            <div class="col-6 col-lg-6 col-sm-6  ">
                                <a class="btn btn-success  btn-block rounded-5 " href="/verPerfil/{{$afiliado->user_id}}">{{__('View profile')}}</a>
                            </div>
                            <div class="col-6 col-lg-6 col-sm-6  text-end">
                                <a class="btn btn-success  btn-block rounded-5" href="/verProductoAfiliado/{{$afiliado->user_id}}">{{__('View products')}}</a>
                            </div>

                        </div>
                        </div>
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
                    {{$datos->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection