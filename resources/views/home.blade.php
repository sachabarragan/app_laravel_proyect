@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.show-message')
            @foreach ($weeds as $weed)
            
            <div class="card">
                <?php $user=Auth::user()->id; $yaVoto = 0;?>
                <?php $cantidad = 0; $contador=0; $smokeThis = 0; $shareThis = 0; $plantThis = 0; $eatThis = 0; $hitThis = 0; $smoke=0; $eat = 0; $share = 0; $plant = 0; $hit = 0;?>
                
                @foreach($weed->likes as $like)
                    <?php 
                    if($like->user_id == $user){
                        $yaVoto = 1;
                    }
                    $smokeThis += $like->would_smoke;
                    $shareThis += $like->would_share;
                    $plantThis += $like->would_plant; 
                    $eatThis += $like->would_eat;   
                    $hitThis += $like->it_hits_me;


                    $contador++;?> 
                @endforeach
                
                    <?php 
                    if($contador > 0){
                        $smoke = (int)($smokeThis/$contador);
                        $share = (int)($shareThis/$contador); 
                        $plant = (int)($plantThis/$contador);
                        $eat = (int)($eatThis/$contador);
                        $hit = (int)($hitThis/$contador);
                    }
                    ?>
                
                <a href="{{ route('user.profile', ['id' => $weed->user->id ])}}">
                    <div class="card-header d-flex justify-content-between">
                    
                        {{ $weed->user->name.' @'.$weed->user->user_name }}
                        @if($weed->user->image )
                        <div class="avatar-nav">
                            <img src="{{ route('user.avatar', ['filename'=> $weed->user->image ]) }}" alt=""/>
                        </div>
                        @endif
                        


                    </div> 
                </a>

                <div class="card-body">
                    <a href="{{ route('weed.detail', ['id'=> $weed->id ]) }}">
                        <div class="d-flex justify-content-center imgUnic">
                            <img src="{{ route('weed.image', ['weedName'=> $weed->image_path ]) }}" alt="">
                        </div>
                    </a>
                    <div class="d-flex justify-content-left">
                        {{ \FormatTime::LongTimeFilter($weed->created_at) }}
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>{{ $weed->titulo }}</div>
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
                    
                </div>
                <div class="d-flex justify-content-center">Votos: {{ count($weed->likes) }}</div>
                <div class="d-flex justify-content-between likes" id="likesId">
                    <div>
                        <div class="d-flex justify-content-center bgGral smoke bg0{{ $smoke }}" data-like="bg0{{ $smoke }}"> Would Smoke</div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-center bgGral eat bg0{{ $eat }}" data-like="bg0{{ $eat }}">Would Eat</div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-center bgGral plant bg0{{ $plant }}" data-like="bg0{{ $plant }}">Would Plant</div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-center bgGral share bg0{{ $share }}" data-like="bg0{{ $share }}">Would Share</div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-center bgGral hit bg0{{ $hit }}" data-like="bg0{{ $hit }}">It Hit's Me</div>
                    </div>
                    
                </div>
                @if($yaVoto == 0)
                <button class="d-flex justify-content-center votacion" id="paraVotar">Votar</button>
                <div class="escondido weed_id_{{$weed->id}}" id="formHome" data-id="{{$weed->id}}">
                    <input type="hidden" value="home" name="came_from">
                @csrf
                    <div class="d-flex justify-content-between likes">
                        <input type="hidden" name="weed_id" value="{{ $weed->id }}">
                        <div class="smokeSi">
                            <div class="d-flex justify-content-center smokeInputDiv"><input class="likeInput" name="would_smoke" id="would_smoke" type="range" min="0" max="10" value="{{$smoke}}"></div>
                            <div class="d-flex justify-content-center"> Would Smoke</div>
                        </div>
                        <div class="eatSi">
                            <div class="d-flex justify-content-center eatInputDiv"><input class="likeInput" name="would_eat" id="would_eat" type="range" min="0" max="10" value="{{$eat}}"></div>
                            <div class="d-flex justify-content-center">Would Eat</div>
                        </div>
                        <div class="plantSi">
                            <div class="d-flex justify-content-center plantInputDiv"><input class="likeInput" name="would_plant" id="would_plant" type="range" min="0" max="10" value="{{$plant}}"></div>
                            <div class="d-flex justify-content-center">Would Plant</div>
                        </div>
                        <div class="shareSi">
                            <div class="d-flex justify-content-center shareInputDiv"><input class="likeInput" name="would_share" id="would_share" type="range" min="0" max="10" value="{{$share}}"></div>
                            <div class="d-flex justify-content-center">Would Share</div>
                        </div>
                        <div class="hitSi">
                            <div class="d-flex justify-content-center hitInputDiv"><input class="likeInput" name="it_hits_me" id="it_hits_me" type="range" min="0" max="10" value="{{$hit}}"></div>
                            <div class="d-flex justify-content-center">It Hit's Me</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center"><button class="botonVotar">Votar</button></div> 
                </div>
                @else
                    <h6 class="d-flex justify-content-center">Ya votaste esta weed</h6>
                @endif


                <div class="d-flex justify-content-center">Comentarios ({{count($weed->comments)}})</div>
            </div>
            
            <hr>
            @endforeach
            <div class="clearfix"></div>
                {{ $weeds->links() }}
            </div>
        </div>
        
</div>
@endsection
