@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>Editar {{ $video->titulo }}</h1>
        <hr>
        <form method="post" action="{{ route('updateVideo',array('video_id'=>$video->id)) }}" enctype="multipart/form-data" class="col-lg-7">
            {!! csrf_field() !!}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="form-group">
                <label for="titulo">Titulo</label>
                <input type="text" id="titulo" name="titulo" class="form-control" value="{{ $video->titulo }}">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion">{{ $video->descripcion }}</textarea>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <!-- mostrar imagen -->
                @if(Storage::disk('imagenes')->has($video->imagen))
                <div class="video-imagen-thumb">
                    <div class="video-imagen-mascara">
                        <img src="{{ url('/miniatura/'.$video->imagen) }}" class="video-imagen">
                    </div>
                </div>
                @endif
                <input type="file" id="imagen" name="imagen">
            </div>
            <div class="form-group">
                <label for="video">Video</label>
                <!-- video -->
                <video controls id="video-player">
                    <source src="{{ route('fileVideo', array('filename'=> $video->video_path)) }}">
                    Tu navegador HTML5
                </video>
                <input type="file" id="video" name="video">
            </div>
            <button class="btn btn-success" type="submit">Guardar cambios</button>
        </form>
    </div>
</div>
@endsection