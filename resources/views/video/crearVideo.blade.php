@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>Crear Video</h1>
        <hr>
        <form method="post" action="{{ route('guardarVideo') }}" enctype="multipart/form-data" class="col-lg-7">
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
                <input type="text" id="titulo" name="titulo" class="form-control" value="{{ old('titulo') }}">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <textarea class="form-control" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" name="imagen">
            </div>
            <div class="form-group">
                <label for="video">Video</label>
                <input type="file" id="video" name="video">
            </div>
            <div class="form-group">
                <label for="playlist">Lista de Reproduccion</label>
                <select class="form-control" name="playlist">
                    <option value="">Seleccione...</option>
                    @foreach($listas as $lista)
                    <option value="{{$lista->id}}">{{ $lista->titulo }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-success" type="submit">Crear video</button>
        </form>
    </div>
</div>
@endsection