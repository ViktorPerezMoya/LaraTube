@extends('layouts.app')

@section('content')
<div class="col-md-10 col-md-offset-1">
    <h2>{{ $video->titulo }}</h2>
    <hr>
    <div class="col-md-8">
        <!-- video -->
        <video controls id="video-player">
            <source src="{{ route('fileVideo', array('filename'=> $video->video_path)) }}">
            Tu navegador HTML5
        </video>
        <!-- descripcion -->
        <div class="panel panel-default panel-data">
            <div class="panel-heading">
                <div class="panel-title">
                    Subido por <strong><a href="{{ route("canal", ['user_id' => $video->usuario->id]) }}">{{ $video->usuario->nombre }}</a></strong> {{ \FormatTime::LongTimeFilter($video->created_at) }}
                </div>
            </div>
            <div class="panel-body">
                {{ $video->descripcion }}
            </div>
        </div>
        <!-- comentario -->
        @include('video.comentario')
    </div>
</div>
@endsection