@extends('layouts.master')
@section('titulo')
Editar perfil
@endsection
@section('body')
@foreach($datosPerfil as $datos)
<div class="container mt-3 ">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <fieldset class="mt-2 mx-5">
        <h1>{{__('Profile edit')}}</h1>
        <div class="row">
            <div class="col-12">
                <div class="row ">
                    <div class="col-5">
                        <div class="mx-5 mt-5 mb-5 ">
                            <form method="post" action="javascript:void(0)" id="image-upload" enctype="multipart/form-data">
                                <div class="col-6 mx-5 ">
                                    <div class="d-flex justify-content-center "  style="width: 15rem; height: 15rem;">
                                        <?php
                                        if (isset($datos->foto)) {//Si no hay imagen pone una por defecto
                                        ?> <img class="img-fluid " style="max-width: 300px;" id="imagen" src="{{URL::asset('imagenes/'.$datos->user_id.'.jpeg')}}" alt="{{$datos->foto}}">
                                        <?php
                                        } else { ?>
                                            <img class="img-fluid " style="max-width: 300px;" id="imagen" src="{{URL::asset('imagenes/images.png')}}" alt="Foto de perfil">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="image">{{__('Upload image')}}</label>
                                                    <input type="file" class="form-control-file" name="image" id="image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="/perfil/edicion/{{$datos->user_id}}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="col-12  mt-5 ">
                            <div class="row mx-5 ">
                                <div class="col-5 mt-5">
                                    {{__('First name')}}<br>
                                    <input type="text" name="nombre" value="{{$datos->nombre}}"><br>
                                    {{__('Last name')}}<br>
                                    <input type="text" name="apellidos" value="{{$datos->apellidos}}"><br>
                                    {{__('Description')}}<br>
                                    <textarea name="descripcion" rows="5" cols="20">{{$datos->descripcion}}</textarea><br>
                                </div>
                                <div class="col-7 mt-5">
                                    {{__('Country')}}<br>
                                    <input type="text" name="pais" value="{{$datos->pais}}"><br>
                                    {{__('City')}}<br>
                                    <input type="text" name="ciudad" value="{{$datos->ciudad}}"><br>
                                    {{__('Postal code')}}<br>
                                    <input type="text" name="CP" value="{{$datos->CP}}"><br>
                                    {{__('Street number and gate')}} <br>
                                    <input type="text" name="calle" value="{{$datos->calle_numero}}"><br>
                                    {{__('Floor/door or block')}}<br>
                                    <input type="text" name="piso" value="{{$datos->piso_puerta_bloque}}"><br><br><br>
                                    <input class="btn btn-primary mx-5 px-5" type="submit" name="editar" value="{{__('Edit')}}">
                                </div>
                            </div>
                            <br><br>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </fieldset>
</div>
<script>
    $(document).ready(function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#image').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagen').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
            // });
            // $('#image-upload').submit(function(e) {
            // e.preventDefault();
            //var formData = new FormData(this);
            var formData = new FormData($('#image-upload')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ url('upload')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#image-upload')[0].reset();
                    alert('{{__("The image was upload sucessfully")}}');
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    });
</script>

@endforeach
@endsection