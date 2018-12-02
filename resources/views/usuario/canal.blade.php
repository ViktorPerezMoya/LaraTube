@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            <h2>Canal de {{ $usuario->nombre }}</h2>
            
            <div class="clearfix"></div>
            <hr>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#videos_div" aria-controls="videos_div" role="tab" data-toggle="tab">Vidos</a>
                </li>
                <li role="presentation">
                    <a href="#playlist_div" aria-controls="playlist_div" role="tab" data-toggle="tab">PlayList</a>
                </li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="videos_div">
                    @include('video.videosList')
                </div>
                <div role="tabpanel" class="tab-pane" id="playlist_div">
                    @include('video.playlistList')
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
