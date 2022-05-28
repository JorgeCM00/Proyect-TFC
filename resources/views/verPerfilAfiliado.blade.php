@extends('layouts.master')
@section('titulo')
Perfil
@endsection
@section('body')
<?php

use Illuminate\Support\Facades\Auth; ?>
@foreach($datosPerfil as $datos)
<div class="container">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="container mt-3 ">
        <fieldset>
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <h1> {{__('Profile')}}</h1>
                    </div>
                    <div class="col-6">
                        <?php if (Auth::user()) {
                            if ($datos->user_id == Auth::user()->id) { ?>
                                <div class="float-end">
                                    <a href="/perfil/edicion/{{$datos->user_id}}"><button class="btn btn-primary mt-2">{{__('Edit')}}</button></a>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row  d-flex justify-content-center align-items-center ">
                <div class="col-12 col-sm-12 col-lg-12  mb-5">
                    <div class="row">
                        <div class="col-5 col-sm-12 col-lg-5">
                            <div class="card mx-5 mt-5 mb-5 border border-0  " style="width: 15rem;  background-color:#FFFFFF00 ">
                                <div class="col-12 col-sm-12 col-lg-12 ">
                                    <div class="card-img-top text-center">
                                        <?php
                                        if (isset($datos->foto)) {
                                        ?> <img class="img-fluid border border-1" style="width: 12rem;" src="{{URL::asset('imagenes/'.$datos->user_id.'.jpeg')}}" alt="{{$datos->foto}}">
                                        <?php
                                        } else { ?>
                                            <img class="img-fluid border border-1" style="width: 12rem;" id="imagen" src="{{URL::asset('imagenes/images.png')}}" alt="Foto de perfil">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                @foreach($datosAfiliado as $afiliado)
                                <div class="card-body">
                                    <h5 class="card-title">Biografia</h5>
                                    {{$afiliado->bio}}
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{__('Social media')}}</h5>
                                    <ul class="list-group list-group-flush "style=" background-color:#FFFFFF00 ">
                                        <input type="hidden" name="afiliado_id" value="{{$afiliado->user_id}}">
                                        <li class="list-group-item  "style=" background-color:#FFFFFF00 ">
                                            <pre>Twitter:       <a href="https://twitter.com/{{$afiliado->twitter}}">{{$afiliado->twitter}}</a></li> </pre>
                                        <li class="list-group-item  "style=" background-color:#FFFFFF00 ">
                                            <pre>Instagram:     <a href="https://www.instagram.com/{{$afiliado->insta}}">{{$afiliado->insta}}</a></li></pre>
                                        <li class="list-group-item  "style=" background-color:#FFFFFF00 ">
                                            <pre>{{__('email')}}: {{$datos->email}}</li></pre>

                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="col-7 col-sm-12 col-lg-7">
                            <div class="col-12 my-5 py-5 justify-content-center fs-5"  >

                               <p>
                                {{__('First name')}}:
                                {{$datos->nombre}}</p>
                              <p>  {{__('Last name')}}:
                                {{$datos->apellidos}}</p>
                               <p style="word-wrap: break-word;"> {{__('Description')}}:
                                {{$datos->descripcion}}</p>



                               
                                <p>{{__('Country')}}:
                                {{$datos->pais}}</p>

                                <p>{{__('City')}}:
                                {{$datos->ciudad}}</p>

                                <p>{{__('Postal code')}}:
                                {{$datos->CP}}</p>

                                <p>{{__('Street number and gate')}}:
                                {{$datos->calle_numero}}</p>

                              <p>  {{__('Floor/door or block')}}:
                                {{$datos->piso_puerta_bloque}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>

    <!--<legend> Usuario </legend>{{-- $id->user --}}-->
    <!--Esto es un comentario en blade, ahí iria el nombre del usuario que entra en su perfil, es decir el perfil al que accede -->

    <!--Como hacer para poder poner aquí el perfil, y saber si existe el perfil o no -->
    <!--Preguntarle a marcos si debería hacer 2 blades, o si debería hacer para cada campo un condicional de si existe ponerlo. else No.-->
</div>
@endforeach
@endforeach
@endsection