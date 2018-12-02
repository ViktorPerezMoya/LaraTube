
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Listas de reproducción</h1>
            @if(session('mensaje'))
            <div class="alert alert-success">
                {{ session('mensaje') }}
            </div>
            @endif
            @if(!empty(auth()->user()->id))
            <a href="{{ url('/new_play_list') }}" class="btn btn-primary" style="float: right">Nueva Lista</a>
            @endif
            <br><br>
            <div class="accordion" id="my_acordeon">
                @foreach($listas as $lista)
                <div class="card">
                  <div class="card-header" id="{{ 'head_'.$lista->id }}">
                    <h5 class="mb-0">
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="{{ '#collapse_'.$lista->id }}" aria-controls="{{ 'collapse_'.$lista->id }}">
                        {{ $lista->titulo }}
                        <span class="badge" style="margin-left: 10px;">{{ count($lista->videos) }}</span>
                        @if(!empty(auth()->user()->id) && auth()->user()->id == $lista->usuario_id)
                        <a href="{{ url('/editar_playlist/'.$lista->id) }}"><span class="badge" style="margin-left: 10px;background-color: blueviolet;">Editar</span></a>
                        @endif
                      </button>
                    </h5>
                  </div>

                  <div id="{{ 'collapse_'.$lista->id }}" class="collapse" aria-labelledby="{{ 'head_'.$lista->id }}" data-parent="#my_acordeon">
                      <div class="card-body">
                        
                          <ul style="list-style: none;">
                            @foreach($lista->videos as $video)
                            <li style="background-color: silver;padding: 20px;">
                                <a href="{{ route('videoDetalle', array('video_id' => $video->id)) }}" style="text-decoration: none;color: white;">
                                    <img src="{{ url('/miniatura/'.$video->imagen) }}" style="width: 75px;height: 50px;">
                                    {{ $video->titulo }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                  </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>