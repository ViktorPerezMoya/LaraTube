@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            <h2>Busqueda: {{ $search }}</h2>
            @include('video.videosList')
        </div>
    </div>
</div>
@endsection
