@extends('layouts.master')
@section('titulo')
Editado correctamente
@endsection
@section('body')
<div class="container my-5 py-5 px-5 bg-light shadow-sm">
    <div class="col-12 col-lg-12 col-sm-12">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6 col-lg-6 col-sm-12">
                        <div class="d-flex justify-content-center">
                        <h2><strong>{{__('The profile was edited succesfully')}}</strong></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
