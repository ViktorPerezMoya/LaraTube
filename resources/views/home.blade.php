@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            @if(session('mensaje'))
            <div class="alert alert-success">
                {{ session('mensaje') }}
            </div>
            @endif
            
            @include('video.videosList')
        </div>
    </div>
</div>
@endsection
