@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            <div class="col-md-6">
                <h2>Busqueda: {{ $search }}</h2>
            </div>
            <div class="col-md-6">
                <br>
                <form action="{{ url('/buscar/'.$search) }}" method="get" class="col-md-10 pull-right">
                    <div class="form-inline">
                    <div class="form-group">
                        <label for="filtro">Ordenar por</label>
                        <select name="filtro" id="filtro" class="form-control">
                            <option value="new">Mas nuevos primero</option>
                            <option value="old">Mas antiguos primero</option>
                            <option value="alfa">De la A a la Z</option>
                        </select>
                    </div>
                    <input type="submit" value="Ordenar" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>
            <hr>
            @include('video.videosList')
        </div>
    </div>
</div>
@endsection
