@extends('layouts.master')
@section('titulo')
CrearProducto
@endsection
@section('body')
<div class="d-flex flex-row justify-content-center alig-items-center my-4">
    <div class="justify-content-center">
        <div class="card border-secondary bg-light  rounded-5 my-5" style="width: 70rem">

            <div class="card-header p-0">
                <div class="bg-success p-2  bg-opacity-75 text-center py-2">
                    <p class="m-0">{{__('New product')}}</label>

                </div>
            </div>

            <form method="post" action="javascript:void(0)" id="image-upload" enctype="multipart/form-data">
                <div class="text-center mt-4">
                    <img class="img-fluid" src="{{URL::asset('productos/Producto.jpeg')}}" id="imagen" alt="Foto producto" style="width: 200px;">

                    <div class="row">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="image">{{__('Upload image')}}</label>
                                <input type="file" class="form-control-file" name="image" id="image" required>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form action="/crearProducto/{{$afiliado->user_id}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="d-flex justify-content-center">
                    <div class="row mt-2">

                        <div class="card-body p-3">
                            <label for="nombre">{{__('First name')}}</label>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend"></div>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                            </div>

                            <label class="mt-2" for="descripcion">{{__('Description')}}:</label>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend"></div>

                                    <textarea name="descripcion" id="editor"></textarea>

                                </div>
                            </div>

                            <label class="mt-2" for="stock">Stock:</label>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend"></div>
                                    <input type="number" min="0" class="form-control" id="stock" name="stock" required></textarea>
                                </div>
                            </div>
                            <label class="mt-2" for="IVA">IVA: </label>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend"></div>
                                    <select class="form-select" aria-label="Default select example" name="IVA">
                                        <option selected>IVA</option>
                                        <option value="21">21%</option>
                                        <option value="10">10%</option>
                                        <option value="4">4%</option>
                                    </select>
                                </div>
                            </div>
                            <label class="mt-2" for="precio">{{__('Price')}}:</label>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend"></div>
                                    <input type="number" min="0" class="form-control" id="precio" name="precio" required></textarea>
                                </div>
                            </div>
                            <div style="word-wrap: break-word;">
                                {{__('Labels:(Ctrl + click to select more than one)')}}<br>
                                <select class="form-select" name="etiquetas[]" multiple>
                                    @foreach($etiquetas as $etiqueta)
                                    <option id="{{$etiqueta->id}}" value="{{$etiqueta->id}}">
                                        {{$etiqueta->nombreEtiqueta}}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="text-center mt-4">
                                    <input type="submit" name="enviar" value="{{__('Submit')}}" class="btn btn-success text-black btn-block rounded-5 py-2 ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
</div>

<script>
    $(document).ready(function(e) {//Ajax para subir la imagen
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
                url: "{{ url('subir')}}",
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
<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>

@endsection