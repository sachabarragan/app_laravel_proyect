@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.show-message')
           
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ $weed->user->name. ' @'.$weed->user->user_name}}
                    
                    @if($weed->user->image )
                    <div class="avatar-nav">
                        <img src="{{ route('user.avatar', ['filename'=> $weed->user->image ]) }}" alt=""/>
                    </div>
                    @endif
                </div>

                <div class="card-body">
                    
                    <div class="d-flex justify-content-center imgUnic">
                        <img src="{{ route('weed.image', ['weedName'=> $weed->image_path ]) }}" alt="">
                    </div>
                    <div class="d-flex justify-content-left">
                        {{ \FormatTime::LongTimeFilter($weed->created_at) }}
                    </div>
                    <div class="d-flex justify-content-between">
                        <div> {{ $weed->breed }}</div>
                        
                        <div>
                            @if($weed->auto == 'Si')
                                Autofloreciente
                            @else
                                Regular
                            @endif
                        </div>
                        <div>{{ $weed->kind }}</div>
                        <div>CBD: {{ $weed->cbd }}</div>
                        <div>THC: {{ $weed->thc }}</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div></div>
                        <div>
                            @if($weed->auto != 'si')
                                Periodo vegetativo {{ $weed->veg_time}}
                            @endif
                        </div>
                        <div>Periodo de floracion {{ $weed->flow_time }}</div>
                        <div></div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <div>
                            <p class="text-center">{{ $weed->description }}</p>
                        </div>
                    </div>
                    
                </div>
                
                @if(Auth::user()->id && ($weed->user->id == Auth::user()->id))
                    <div>
                        <a href="{{ route('weed.edit', ['id' => $weed->id]) }}" class="btn btn-primary btn-sm">Actualizar</a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                        Borrar
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" data-toggle="modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Loco, ¿La vas a borrar?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Si borras esto no lo recuperás más, no flashees
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="{{ route('weed.delete', ['id' => $weed->id]) }}" class="btn btn-danger btn-sm">Borrar</a>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                @endif
                <div class="d-flex justify-content-between likes">
                    <div>
                        <div class="d-flex justify-content-center bgGral bg0{{$likes->would_smoke}}"> Would Smoke</div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-center bgGral bg0{{$likes->would_eat}}">Would Eat</div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-center bgGral bg0{{$likes->would_plant}}">Would Plant</div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-center bgGral bg0{{$likes->would_share}}">Would Share</div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-center bgGral bg0{{$likes->it_hits_me}}">It Hit's Me</div>
                    </div>
                    
                </div>
                @if($yaVoto == 0)
                    <form method="GET" action="{{ route('like.like') }}">
                    <input type="hidden" value="detail" name="came_from">
                    @csrf
                        <div class="d-flex justify-content-between likes">
                            <input type="hidden" name="weed_id" value="{{ $weed->id }}">
                            <div>
                                <div class="d-flex justify-content-center"><input class="likeInput" name="would_smoke" type="range" min="0" max="10" value="{{$likes->would_smoke}}"></div>
                                <div class="d-flex justify-content-center"> Would Smoke</div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-center"><input class="likeInput" name="would_eat" type="range" min="0" max="10" value="{{$likes->would_eat}}"></div>
                                <div class="d-flex justify-content-center">Would Eat</div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-center"><input class="likeInput" name="would_plant" type="range" min="0" max="10" value="{{$likes->would_plant}}"></div>
                                <div class="d-flex justify-content-center">Would Plant</div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-center"><input class="likeInput" name="it_hits_me" type="range" min="0" max="10" value="{{$likes->it_hits_me}}"></div>
                                <div class="d-flex justify-content-center">It Hit's Me</div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-center"><input class="likeInput" name="would_share" type="range" min="0" max="10" value="{{$likes->would_share}}"></div>
                                <div class="d-flex justify-content-center">Would Share</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center"><button type="submit">Votar</button></div> 
                    </form>
                @else
                    <h6 class="d-flex justify-content-center">Ya votaste esta weed</h6>
                @endif
                
                <div class="d-flex justify-content-center">Comentarios ({{count($weed->comments)}})</div> 
                <div class="clearfix"></div>
                
                <form method="POST" action="{{ route('comment.save') }}" class="formComments">
                @csrf
                    <div class="row">
                        <div class="col-10">
                            <input type="hidden" name="weed_id" value="{{$weed->id}}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <p><textarea class="form-control {{ $errors->has('content') ? 'isInvalid' : '' }}" name="content"  cols="1" rows="3" maxlength ="100" required></textarea></p>
                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-2">
                            <button type="submit" class="enviarComentario">Comment</button>
                        </div>
                    </div>
                </form>

                <div class="clearfix"></div>
                <div class="clearfix"></div> 
                    @foreach($weed->comments as $comment)
                        <div class="row">
                        
                                <div class="col-2 text-center">
                                    {{ $comment->user->name }}
                                    {{ \FormatTime::LongTimeFilter($comment->created_at)}}
                                </div>
                                <div class="col-8 text-center">
                                {{ $comment->comments }}
                                </div>
                                @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->weed->user_id == Auth::user()->id ))
                                    <div class="col-2 text-center">
                                        <a href="{{ route('comment.delete', ['id' => $comment->id]) }}">
                                        Borrar
                                        </a>
                                    </div>
                                @endif
                        
                        </div>
                        <div class="clearfix"></div>
                    @endforeach
            </div>
                
                
        </div>
    </div>    
</div>
@endsection
