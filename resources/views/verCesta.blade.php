@extends('layouts.master')
@section('titulo')
Perfil
@endsection
@section('body')

<div class="container ">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <?php
    if (isset($datosCesta[0])) {
    ?>
        <div class="container my-5 py-5 px-5 bg-light shadow-sm">
            <div class="col-12 col-lg-12 col-sm-12">
                <div class="row">
                    <h1 class="fw-bold mb-4 text-primary">{{ __('Cart') }}</h1>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-center px-2">

                            <form action="/comprar/{{ auth()->id() }}" method="post">
                                @csrf
                                <table class="table table-striped">
                                    <thead>
                                        <th class="align-middle text-center">{{__('Image')}}</th>
                                        <th class="align-middle text-center">{{__('Name')}}</th>
                                        <th class="align-middle text-center">{{__('Amount')}}</th>
                                        <th class="align-middle text-center">{{__('Unit price')}}</th>
                                        <th class="align-middle text-center">{{__('Action')}}</th>
                                    </thead>
                                    <tbody>

                                        @foreach ($datosCesta as $cesta)

                                        <tr>
                                            <td><img src="{{URL::asset('productos/'.$cesta->imagen)}}" class="img-fluid " style="max-width: 150px;  "></td>
                                            <td class="fw-bold mb-4  align-middle text-center" style="word-wrap: break-word;">{{$cesta->nombre}}</td>
                                            <td class="fw-bold mb-4  align-middle text-center">{{$cesta->cantidad}}</td>
                                            <td class="fw-bold mb-4  align-middle text-center">{{$cesta->precio}} €</td>
                                            <td class="fw-bold mb-4 align-middle text-center"> <a class="btn btn-success  btn-block rounded-5 py-2" href="/cesta/delete/{{$cesta->producto_id}}">{{__('Delete')}}</a></td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                                <?php //Coje el precio total
                                $cont = $datosCesta->count();
                                $total = 0;
                                for ($i = 0; $i < $cont; $i++) {
                                    $precio = floatval($datosCesta[$i]->precio);
                                    $cantidad = intval($datosCesta[$i]->cantidad);
                                    $total += $precio * $cantidad;
                                }
                                ?>
                                <div class="row my-4">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend"></div>
                                                <select class="form-select  bg-secondary bg-opacity-75" aria-label="Default select example" name="pago">
                                                    <option selected disabled>{{__('Payment method')}} </option>
                                                    <option value="efectivo">{{__('Cash')}}</option>
                                                    <option value="tarjeta">{{__('Credit card')}}</option>
                                                    <option value="paypal">{{__('Paypal')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-6 col-lg-6 col-sm-6  ">
                                        <div class="fs-5 fw-bold"> {{__('Total price')}} <?php echo $total . '€'; ?></div>
                                        <input type="hidden" name="precioTot" value="<?php echo $total ?>">
                                    </div>
                                    <div class="col-6 col-lg-6 col-sm-6  text-end">
                                        <input class="btn btn-success  btn-block rounded-5 py-2" type="submit" name="pagar" value="{{__('Pay')}}">
                                    </div>

                                </div>
                            </form>
                            <?php

                            ?>
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
                                    <h2><strong>{{__('Empty cart')}}</strong></h2>

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