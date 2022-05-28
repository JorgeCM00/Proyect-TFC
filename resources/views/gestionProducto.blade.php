@extends('layouts.master')
@section('titulo')
Gestionar producto
@endsection
@section('body')
<div class="d-flex flex-row justify-content-center alig-items-center my-4">
    <div class="justify-content-center">
        <div class="card border-secondary bg-light  rounded-5 my-5" style="width: 70rem">
            <div class="card-header p-0">
                <div class="bg-success p-2  bg-opacity-75 text-center py-2">
                    <p class="m-0">{{__('Edit product')}}</label>

                </div>
            </div>
            <form method="post" action="javascript:void(0)" id="image-upload" enctype="multipart/form-data">
                <div class="text-center mt-4">
                <img class="img-fluid" src="{{URL::asset('productos/'.$producto->imagen)}}" id="imagen" alt="Foto producto" style="width: 200px;">

                    <div class="row">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="image">{{__('Upload image')}}</label>
                                <input type="file" class="form-control-file" name="image" id="image" required>
                                <input type="hidden" value="{{$producto->id}}" name="producto_id">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form action="/gestionProducto/productoEditado/{{$producto->id}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="d-flex justify-content-center">
                    <div class="row mt-2">
                        <div class="card-body p-3">
                        <p>{{__('Product ID')}}: {{$producto->id}}</p>
                        <p>{{__('Created at')}}: {{$producto->created_at}}</p>
                        <p>{{{__('Updated at')}}}: {{$producto->updated_at}}</p>
                            <label for="nombre">{{__('First name')}}:</label>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend"></div>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{$producto->nombre}}" required>
                                </div>
                            </div>

                            <label class="mt-2" for="descripcion">{{__('Description')}}:</label>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend"></div>

                                    <textarea name="descripcion" id="editor">{{$producto->descripcion}}</textarea>

                                </div>
                            </div>

                            <label class="mt-2" for="stock">Stock:</label>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend"></div>
                                    <input type="number" min="0" class="form-control" id="stock" name="stock" value="{{$producto->stock}}" required></textarea>
                                </div>
                            </div>
                            <label class="mt-2" for="IVA">IVA: </label>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend"></div>
                                    <select class="form-select" aria-label="Default select example" name="IVA">
                                        <option value="21" <?php if($producto->IVA==21){echo"selected";}?>>21% </option>
                                        <option value="10"<?php if($producto->IVA==10){echo"selected";}?>>10%</option>
                                        <option value="4"<?php if($producto->IVA==4){echo"selected";}?>>4%</option>
                                    </select>
                                </div>
                            </div>
                            <label class="mt-2" for="precio">{{__('Price')}}:</label>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend"></div>
                                    <input type="number" min="0" class="form-control" id="precio" name="precio" value="{{$producto->precio}}" required></textarea>
                                </div>
                            </div>
       
                            <div style="word-wrap: break-word;">
                            {{__('select with Ctr + click if you dont want to LOSE the previously marked labels)')}}<br>
                                <select class="form-select" name="etiquetas[]" multiple>
                                    
                                  @foreach($etiquetas as $etiqueta) 
                                      
                                    <option  value="{{$etiqueta->id}}" <?php if(in_array($etiqueta->id,$etiquetas_marcadas)){echo"selected";}?> >
                                        {{$etiqueta->nombreEtiqueta}}
                                    </option>
                                    @endforeach
                                    
                                </select>
                            <div class="text-center mt-4">
                                <input type="submit" value="{{__('Edit')}}" class="btn btn-success text-black btn-block rounded-5 py-2 ">
                                <a class="btn btn-success  btn-block rounded-5 py-2" href="/gestionProducto/productoBorrado/{{$producto->id}}">{{__('Delete')}}</a>
                                <a class="btn btn-success  btn-block rounded-5 py-2" href="/misProductos/{{$producto->afiliado_id}}">{{__('Cancel')}}</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </form>
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
                url: "{{ url('editar')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#image-upload')[0].reset();
                    alert('La imagen se subió correctamente');
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