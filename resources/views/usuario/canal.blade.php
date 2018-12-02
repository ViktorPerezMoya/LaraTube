@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            <h2>Canal de {{ $usuario->nombre }}</h2>
            
            <div class="clearfix"></div>
            <hr>
            @include('video.videosList')
        </div>
    </div>
</div>
@endsection
