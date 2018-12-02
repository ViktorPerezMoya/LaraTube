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
                    <div class="row">
                        <div class="col-md-9">
                        Subido por <strong><a href="{{ route("canal", ['user_id' => $video->usuario->id]) }}">{{ $video->usuario->nombre }}</a></strong> {{ \FormatTime::LongTimeFilter($video->created_at) }}
                        </div>
                        @if(!empty(auth()->user()->nombre))
                        <div class="col-md-3 text-right">
                            <input type="hidden" id="video_id_play" value="{{ $video->id}}">
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-primary btn-sm" id="btn_like"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> <span id="sp_likes">{{ $liked_count }}</span></button>
                            <button class="btn btn-primary btn-sm" id="btn_dislike"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span> <span id="sp_dislikes">{{ $disliked_count }}</span></button>
                        </div>
                        @else
                        <div class="col-md-3 text-right">
                            <button class="btn btn-primary btn-sm disabled" ><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> <span id="sp_likes">{{ $liked_count }}</span></button>
                            <button class="btn btn-primary btn-sm disabled" ><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span> <span id="sp_dislikes">{{ $disliked_count }}</span></button>
                        </div>
                        @endif
                    </div>
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