<div id="videos-lista">
    @if(count($videos) >= 1)
    @foreach($videos as $video)
    <div class="video-item col-md-8 pull-left panel panel-default">
        <div class="panel-body">
            <!-- mostrar imagen -->
            @if(Storage::disk('imagenes')->has($video->imagen))
            <div class="video-imagen-thumb col-md-3 pull-left">
                <div class="video-imagen-mascara">
                    <img src="{{ url('/miniatura/'.$video->imagen) }}" class="video-imagen">
                </div>
            </div>
            @endif
            <div class="data">
                <a href="{{ route('videoDetalle', array('video_id' => $video->id))}}"><h4 class="video-titulo">{{ $video->titulo }}</h4></a>
                <p>{{ $video->usuario->nombre }}</p>
            </div>
            <a href="{{ route('videoDetalle', array('video_id' => $video->id)) }}" class="btn btn-primary btn-sm">Ver</a>
            @if(Auth::check() && Auth::user()->id == $video->usuario->id)
            <a href="{{ route('editarVideo', array('video_id' => $video->id)) }}" class="btn btn-warning btn-sm">Editar</a>
            <a href="#modal_delet_{{ $video->id }}" role="button" class="btn btn-sm btn-danger" data-toggle="modal">Eliminar</a>

            <!-- Modal / Ventana / Overlay en HTML -->
            <div id="modal_delet_{{ $video->id }}" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">¿Estás seguro?</h4>
                        </div>
                        <div class="modal-body">
                            <p>¿Seguro que quieres borrar este video?</p>
                            <p class="text-warning"><small>{{ $video->texto }}</small></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <a href="{{ url('/borrar-video/'.$video->id) }}" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endforeach
    @else
    <div class="alert alert-danger">No hay videos coincidentes con su busqueda.</div>
    @endif
    <div class="clearfix"></div>
    {{ $videos->links() }}
</div>