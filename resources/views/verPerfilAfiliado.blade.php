@extends('layouts.master')
@section('titulo')
Perfil
@endsection
@section('body')
<?php

use Illuminate\Support\Facades\Auth; ?>
@foreach($datosPerfil as $datos)
<div class="container px-5">
    <div class="col-12">
        <div class="row  my-5">
            <div class="col-6">
                <h1> {{__('Profile')}}</h1>
            </div>
            <?php
            if (Auth::id() == $datos->user_id) {
            ?>
                <div class="col-6">
                    <div class="float-end">
                        <a href="/perfil/edicion/{{$datos->user_id}}"><button class="btn btn-primary mt-2">{{__('Edit')}}</button></a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="row  my-5">
        <div class="col-12 col-lg-6 col-sm-12">

            <?php
            if (isset($datos->foto)) {
            ?> <img class="img-fluid text-center " style="width: 225px;" src="{{URL::asset('imagenes/'.$datos->user_id.'.jpeg')}}" alt="{{$datos->foto}}">
            <?php
            } else { ?>
                <img class="img-fluid text-center " style="width: 225px;" id="imagen" src="{{URL::asset('imagenes/images.png')}}" alt="Foto de perfil">
            <?php
            }
            ?>

            @foreach($datosAfiliado as $afiliado)
            <div class="card-body">
                <h5 class="card-title fw-bold">Biografia</h5>
                {{$afiliado->bio}}
            </div>
            <div class="card-body">
                <h5 class="card-title fw-bold">{{__('Social media')}}</h5>
                <ul class="list-group list-group-flush " style=" background-color:#FFFFFF00 ">
                    <input type="hidden" name="afiliado_id" value="{{$afiliado->user_id}}">
                    <li class="list-group-item  " style=" background-color:#FFFFFF00 ">
                        <pre>Twitter:       <a href="https://twitter.com/{{$afiliado->twitter}}">{{$afiliado->twitter}}</a></li> </pre>
                    <li class="list-group-item  " style=" background-color:#FFFFFF00 ">
                        <pre>Instagram:     <a href="https://www.instagram.com/{{$afiliado->insta}}">{{$afiliado->insta}}</a></li></pre>
                    <li class="list-group-item  " style=" background-color:#FFFFFF00 ">
                        <pre>{{__('email')}}: {{$datos->email}}
                    </li>
                    </pre>

                </ul>
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
                <p>
                    <span class="fw-bold" style="word-wrap: break-word;"> {{__('Description')}}:
                    </span>
                    {{$datos->descripcion}}
                </p>



                <p>
                    <span class="fw-bold">{{__('Country')}}:
                    </span>
                    {{$datos->pais}}
                </p>
                <p>
                    <span class="fw-bold">{{__('City')}}:
                    </span>
                    {{$datos->ciudad}}
                </p>
                <p>
                    <span class="fw-bold">{{__('Postal code')}}:
                    </span>
                    {{$datos->CP}}
                </p>
                <p>
                    <span class="fw-bold">{{__('Street number and gate')}}:
                    </span>
                    {{$datos->calle_numero}}
                </p>
                <p>
                    <span class="fw-bold"> {{__('Floor/door or block')}}:
                    </span>
                    {{$datos->piso_puerta_bloque}}
                </p>

            </div>
        </div>
    </div>
</div>
<!--<legend> Usuario </legend>{{-- $id->user --}}-->
<!--Esto es un comentario en blade, ahí iria el nombre del usuario que entra en su perfil, es decir el perfil al que accede -->

<!--Como hacer para poder poner aquí el perfil, y saber si existe el perfil o no -->
<!--Preguntarle a marcos si debería hacer 2 blades, o si debería hacer para cada campo un condicional de si existe ponerlo. else No.-->
</div>
@endforeach
@endforeach

@endsection