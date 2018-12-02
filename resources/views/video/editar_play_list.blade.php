@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Nueva Lista de reproducción</h1>
            
            <form method="post" action="{{ route('updatePlayList')}}">
                {!! csrf_field() !!}
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="form-group">
                    <label for="titulo">Titulo:</label>
                    <input type="hidden" name="usuario_id" value="{{ auth()->user()->id }}"/>
                    <input type="hidden" name="playlist_id" value="{{ $lista->id }}"/>
                    <input type="text" id="titulo" name="titulo" class="form-control" value="{{ $lista->titulo }}">
                </div>
                <input type="submit" value="Guardar" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection