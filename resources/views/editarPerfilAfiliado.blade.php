@extends('layouts.master')
@section('titulo')
Editar perfil
@endsection
@section('body')
@foreach($datosPerfil as $datos)
@foreach($datosAfiliado as $afiliado)
<div class="container mt-3 px-5 ">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-12">
        <h1 class="my-5">{{__('Profile edit')}}</h1>
        <div class="row">
            <div class="col-12 col-lg-5 col-sm-12">
                <div class="d-flex justify-content-center ">
                    <form method="post" action="javascript:void(0)" id="image-upload" enctype="multipart/form-data">
                        <?php
                        if (isset($datos->foto)) { //Si no hay imagen pone una por defecto
                        ?>
                            <img class="img-fluid " style="max-width: 300px;" id="imagen" src="{{URL::asset('imagenes/'.$datos->user_id.'.jpeg')}}" alt="{{$datos->foto}}">

                        <?php
                        } else { ?>

                            <img class="img-fluid " style="max-width: 300px;" id="imagen" src="{{URL::asset('imagenes/images.png')}}" alt="Foto de perfil">

                        <?php
                        }
                        ?>

                        <div class="form-group my-4">
                            <label for="image" class=" fw-bold">{{__('Upload image')}}</label>
                            <input type="file" class="form-control-file" name="image" id="image">
                        </div>
                    </form>

                </div>
                <form action="/perfil/edicion/{{$datos->user_id}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <?php
                    if (empty($afiliado->user_id)) { //Comprueba si el 
                    } else {
                    ?>

                        <h5> Biografia</h5>
                        <textarea name="bio" rows="2" cols="30">{{$afiliado->bio}}</textarea><br>


                        <h5 class="mt-2">{{__('Social media')}}</h5>
                        <ul class="list-group list-group-flush">
                            <input type="hidden" name="afiliado_id" value="{{$afiliado->user_id}}">
                            <li class="list-group-item" style=" background-color:#FFFFFF00 ">
                                <pre>Twitter:   <input type="text" name="twitter"   placeholder="Usuario en twitter"   value="{{$afiliado->twitter}}" size="20"> </li> </pre>
                            <li class="list-group-item mt-2" style=" background-color:#FFFFFF00 ">
                                <pre>Instagram: <input type="text" name="insta"     placeholder="Usuario en instagram" value="{{$afiliado->insta}}" size="20"></li>   </pre>
                        </ul>

                    <?php
                    }
                    ?>
            </div>
<div class="col-2"></div>
            <div class="col-12 col-lg-5 col-sm-12">
                <div class="d-flex ">


                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row ">
                        <div class="col-12 col-lg-12 col-sm-12">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            {{__('First name')}}<br>
                            <input class="my-1" type="text" name="nombre" value="{{$datos->nombre}}"><br>
                            {{__('Last name')}}<br>
                            <input class="my-1" type="text" name="apellidos" value="{{$datos->apellidos}}"><br>
                            {{__('Description')}}<br>
                            <textarea name="descripcion" rows="5" cols="20">{{$datos->descripcion}}</textarea><br>
                        </div>
                        <div class="col-12 col-lg-12 col-sm-12">
                            {{__('Country')}}<br>
                            <input class="my-1" type="text" name="pais" value="{{$datos->pais}}"><br>
                            {{__('City')}}<br>
                            <input class="my-1" type="text" name="ciudad" value="{{$datos->ciudad}}"><br>
                            {{__('Postal code')}}<br>
                            <input class="my-1" type="text" name="CP" value="{{$datos->CP}}"><br>
                            {{__('Street number and gate')}} <br>
                            <input class="my-1" type="text" name="calle" value="{{$datos->calle_numero}}"><br>
                            {{__('Floor/door or block')}}<br>
                            <input class="my-1" type="text" name="piso" value="{{$datos->piso_puerta_bloque}}"><br><br><br>
                            <input class="btn btn-primary mx-5 px-5" type="submit" name="editar" value="{{__('Edit')}}">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <br><br>
    </div>
</div>

</div>
</div>
</div>
</div>
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
@endforeach
@endsection