@extends('layouts.master')
@section('titulo')
Perfil
@endsection
@section('body')
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
                        <div class="float-end">
                            <a href="edicion/{{$datos->user_id}}"><button class="btn btn-primary mt-2">{{__('Edit')}}</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12  mb-5">
                    <div class="row">
                        <div class="col-5 col-lg-5 col-sm-12">
                            <div class="mx-5 mt-5 mb-5" style="width: 15rem;">
                                <div class="col-12 text-center">
                                        <?php
                                        if (isset($datos->foto)) {
                                        ?> <img class="img-fluid text-center " style="max-width: 300px;" src="{{URL::asset('imagenes/'.$datos->user_id.'.jpeg')}}" alt="{{$datos->foto}}">
                                        <?php
                                        } else { ?>
                                            <img class="img-fluid text-center " style="max-width: 300px;" id="imagen" src="{{URL::asset('imagenes/images.png')}}" alt="Foto de perfil">
                                        <?php
                                        }
                                        ?>    
                                </div>
                            </div>
                        </div>
                        <div class="col-7 col-sm-12 col-lg-7">
                        <div class="col-12   mx-5 my-5 py-4 justify-content-center fs-5">

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
            </div>
        </fieldset>
    </div>

   
</div>

@endforeach
@endsection