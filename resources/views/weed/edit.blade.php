@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.show-message')
            <div class="card">
            
                <div class="card-header">Edit la Weed</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('weed.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div><input type="hidden" name="weedId" value="{{ $weed->id }}"></div>
                        <div class="form-group">
                            <label for="image_path">Cambia la imagen, o mantenla</label>
                            <img src="{{ route('weed.image', ['weedName' => $weed->image_path]) }}" alt="" class="miniImagen">
                            <input type="file" class="form-control-file" id="image_path" name="image_path" required>
                            @error('image_path')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="titulo">Titulo</label>
                            <input type="text" class="form-control" name="titulo" id="titulo" value="{{$weed->titulo}}" required>
                            @error('titulo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="auto">¿Autofloreciente?</label>
                            <select class="form-control" id="auto" name="auto" required >
                                @if($weed->auto == 'Si')
                                    <option selected>Si</option>
                                    <option>No</option>
                                @else
                                    <option>Si</option>
                                    <option selected>No</option>
                                @endif
                            </select>
                            @error('auto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                        <label for="breed">Raza</label>
                            <input type="text" class="form-control" name="breed" id="breed" value="{{$weed->breed}}" required>
                            @error('breed')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="kind">¿Tipo?</label>
                            <select class="form-control" id="kind" name="kind" required>
                                @if( $weed->kind == 'Indica')
                                    <option selected>Indica</option>
                                    <option>Sativa</option>
                                    <option>Hibrida indica/Sativa</option>
                                    <option>Sin identificar</option>
                                @elseif($weed->kind == 'Sativa')
                                    <option>Indica</option>
                                    <option selected>Sativa</option>
                                    <option>Hibrida indica/Sativa</option>
                                    <option>Sin identificar</option>
                                @elseif($weed->kind == 'Hibrida indica/sativa')
                                    <option>Indica</option>
                                    <option>Sativa</option>
                                    <option selected>Hibrida indica/Sativa</option>
                                    <option>Sin identificar</option>
                                @else
                                    <option>Indica</option>
                                    <option>Sativa</option>
                                    <option>Hibrida indica/Sativa</option>
                                    <option selected>Sin identificar</option>
                                @endif
                            </select>
                            @error('kind')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="cbd">¿CBD?</label>
                                <select class="form-control" id="cbd" name="cbd" required>
                                    @if($weed->cbd == 'Alto')
                                        <option selected>Alto</option>
                                        <option>Medio</option>
                                        <option>Bajo</option>
                                        <option>Sin identificar</option>
                                    @elseif($weed->cbd == 'Medio')
                                        <option>Alto</option>
                                        <option selected>Medio</option>
                                        <option>Bajo</option>
                                        <option>Sin identificar</option>
                                    @elseif($weed->cbd == 'Bajo')
                                        <option>Alto</option>
                                        <option>Medio</option>
                                        <option selected>Bajo</option>
                                        <option>Sin identificar</option>
                                    @else
                                     <option>Alto</option>
                                        <option>Medio</option>
                                        <option>Bajo</option>
                                        <option selected>Sin identificar</option>
                                    @endif
                                </select>
                                @error('cbd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="thc">¿THC?</label>
                                <select class="form-control" id="thc" name="thc" required>
                                    @if($weed->thc == 'Alto')
                                        <option selected>Alto</option>
                                        <option>Medio</option>
                                        <option>Bajo</option>
                                        <option>Sin identificar</option>
                                    @elseif($weed->thc == 'Medio')
                                        <option>Alto</option>
                                        <option selected>Medio</option>
                                        <option>Bajo</option>
                                        <option>Sin identificar</option>
                                    @elseif($weed->thc == 'Bajo')
                                        <option>Alto</option>
                                        <option>Medio</option>
                                        <option selected>Bajo</option>
                                        <option>Sin identificar</option>
                                    @else
                                        <option>Alto</option>
                                        <option>Medio</option>
                                        <option>Bajo</option>
                                        <option selected>Sin identificar</option>
                                    @endif
                                </select>
                                @error('thc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="veg_time">¿Tiempo de vegetacion?</label>
                                <select class="form-control" id="veg_time" name="veg_time" required>
                                    @if($weed->veg_time == 'Corto')
                                        <option selected>Corto</option>
                                        <option>Medio</option>
                                        <option>Largo</option>
                                        <option>Sin identificar</option>
                                    @elseif($weed->veg_time == 'Medio')
                                        <option>Corto</option>
                                        <option selected>Medio</option>
                                        <option>Largo</option>
                                        <option>Sin identificar</option>
                                    @elseif($weed->veg_time == 'Largo')
                                        <option>Corto</option>
                                        <option>Medio</option>
                                        <option selected>Largo</option>
                                        <option>Sin identificar</option>
                                    @else
                                        <option>Corto</option>
                                        <option>Medio</option>
                                        <option>Largo</option>
                                        <option selected>Sin identificar</option>
                                    @endif
                                </select>
                                @error('veg_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="flow_time">¿Tiempo de floracion?</label>
                                <select class="form-control" id="flow_time" name="flow_time" required>
                                    @if($weed->flow_time == 'Corto')
                                        <option selected>Corto</option>
                                        <option>Medio</option>
                                        <option>Largo</option>
                                        <option>Sin identificar</option>
                                    @elseif($weed->flow_time == 'Medio')
                                        <option>Corto</option>
                                        <option selected>Medio</option>
                                        <option>Largo</option>
                                        <option>Sin identificar</option>
                                    @elseif($weed->flow_time == 'Largo')
                                        <option>Corto</option>
                                        <option>Medio</option>
                                        <option selected>Largo</option>
                                        <option>Sin identificar</option>
                                    @else
                                        <option>Corto</option>
                                        <option>Medio</option>
                                        <option>Largo</option>
                                        <option selected>Sin identificar</option>
                                    @endif
                                </select>
                                @error('flow_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Commentario</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{$weed->description}}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 

                        <button type="submit" class="btn btn-primary">Editar la weed</button>
                    </form> 
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection