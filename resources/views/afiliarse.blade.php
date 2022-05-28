@extends('layouts.master')
@section('titulo')
Afiliarse
@endsection
@section('body')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="/afiliarse/{{$user->id}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <!--Este token hace que no de un error en el paso de datos-->
    <div class="card border-secondary container rounded-5 my-5">
        <div class="card-header p-0">
            <div class="bg-success p-2  bg-opacity-75 text-center py-2">
                <p class="m-0">{{__('Affiliation contract')}}</p>
            </div>
        </div>
        <div class="card-body p-3">
            <div class="form-group">
                <div class="input-group mb-2">
                    <div class="input-group-prepend"></div>
                    <input type="text" class="form-control" id="CIF" name="CIF" placeholder="CIF" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-2">
                    <div class="input-group-prepend"></div>
                    <input type="text" class="form-control" id="NomEmpresa" name="NomEmpresa" placeholder="{{__('Company name')}}" required>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group mb-2">
                    <div class="input-group-prepend"></div>
                    <input type="text" class="form-control" id="tlf" name="tlf" placeholder="{{__('Phone number')}}" required></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group mb-2">
                    <div class="input-group-prepend"></div>
                    <select class="form-select" aria-label="Default select example" name="formaJuridica">
                        <option selected>{{__('Legal form')}}</option>
                        <option value="EmpIndividual">{{__('Empresario individual')}}</option>
                        <option value="SL">{{__('Sociedad Laboral')}}</option>
                        <option value="SA">{{__('Sociedad Anónima')}}</option>
                    </select>
                </div>
            </div><br>

            <div class="text-center">
                <input type="submit" value="{{__('Submit')}}" class="btn btn-success text-black btn-block rounded-5 py-2 ">
            </div>
        </div>
    </div>
</form>

@endsection