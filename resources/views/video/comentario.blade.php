<hr>
<h4>Comentarios</h4>
<hr>
@if(session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

@if(Auth::check())
<form class="col-md-12" method="post" action="{{ url('/comentar') }}">
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
    <input type="hidden" value="{{ $video->id }}" id="video_id" name="video_id" required>
    <p>
        <textarea class="form-control" name="texto" id="texto" rows="4"></textarea>
    </p>
    <input type="submit" value="Comentar" class="btn btn-success">
</form>
<div class="clearfix"></div>
<hr>
@endif

@if(isset($video->comentarios))
<div class="comentarios-list">
    @foreach($video->comentarios as $comentario)
    <div class="comentario-item">
        <div class="panel panel-default comentario-data">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>{{ $comentario->usuario->nombre}}</strong> {{ \FormatTime::LongTimeFilter($comentario->created_at) }}
                </div>
            </div>
            <div class="panel-body">
                {{ $comentario->texto }}
                
                <!-- modal delet comentario -->
                @if(Auth::check() && (Auth::user()->id == $comentario->usuario->id || Auth::user()->id == $video->usuario->id))
                <div class="pull-right">
                    <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                    <a href="#modal_delet_{{ $comentario->id }}" role="button" class="btn btn-sm btn-warning" data-toggle="modal">Eliminar</a>

                    <!-- Modal / Ventana / Overlay en HTML -->
                    <div id="modal_delet_{{ $comentario->id }}" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">¿Estás seguro?</h4>
                                </div>
                                <div class="modal-body">
                                    <p>¿Seguro que quieres borrar este elemento?</p>
                                    <p class="text-warning"><small>{{ $comentario->texto }}</small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <a href="{{ url('/borrar-comentario/'.$comentario->id) }}" class="btn btn-danger">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif