@extends('layouts.master')
@section('titulo')
Perfil
@endsection
@section('body')
@foreach($datosPerfil as $datos)
<div class="container px-5">
    <div class="col-12">
        <div class="row  my-5">
            <div class="col-6">
                <h1> {{__('Profile')}}</h1>
            </div>
            <div class="col-6">
                <div class="float-end">
                    <a href="edicion/{{$datos->user_id}}"><button class="btn btn-primary mt-2">{{__('Edit')}}</button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row  my-5">
        <div class="col-12 col-lg-6 col-sm-12">
            <div class="text-center">
                <?php
                if (isset($datos->foto)) {
                ?> <img class="img-fluid text-center " style="width: 225px;" src="{{URL::asset('imagenes/'.$datos->user_id.'.jpeg')}}" alt="{{$datos->foto}}">
                <?php
                } else { ?>
                    <img class="img-fluid text-center " style="width: 225px;" id="imagen" src="{{URL::asset('imagenes/images.png')}}" alt="Foto de perfil">
                <?php
                }
                ?>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-sm-12  ">
            <div class=" my-5 ">
                <p>
                    <span class="fw-bold">
                        {{__('First name')}}:
                    </span>
                    {{$datos->nombre}}
                </p>
                <p>
                    <span class="fw-bold"> {{__('Last name')}}:
                    </span>
                    {{$datos->apellidos}}
                </p>
                <?php
                if (!isset($datos->descripcion)) {
                } else {
                ?>
                    <p>
                        <span class="fw-bold" style="word-wrap: break-word;"> {{__('Description')}}:
                        </span>
                        {{$datos->descripcion}}
                    </p>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>


@endforeach
@endsection