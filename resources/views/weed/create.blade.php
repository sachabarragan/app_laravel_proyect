@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.show-message')
            <div class="card">
                <div class="card-header">Upload Weed</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('weed.save') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="image_path">Selecciona la Weed</label>
                            <input type="file" class="form-control-file" id="image_path" name="image_path" required>
                            @error('image_path')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="titulo">Titulo</label>
                            <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Tittle of the weed" required>
                            @error('titulo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="auto">¿Autofloreciente?</label>
                            <select class="form-control" id="auto" name="auto" required >
                                <option>Si</option>
                                <option>No</option>
                            </select>
                            @error('auto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                        <label for="breed">Raza</label>
                            <input type="text" class="form-control" name="breed" id="breed" placeholder="Breed of the weed" required>
                            @error('breed')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="kind">¿Tipo?</label>
                            <select class="form-control" id="kind" name="kind" required>
                                <option selected>Indica</option>
                                <option>Sativa</option>
                                <option>Hibrida indica/sativa</option>
                                <option>Sin identificar</option>
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
                                    <option selected>Alto</option>
                                    <option>Medio</option>
                                    <option>Bajo</option>
                                    <option>Sin identificar</option>
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
                                    <option selected>Alto</option>
                                    <option>Medio</option>
                                    <option>Bajo</option>
                                    <option>Sin identificar</option>
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
                                    <option selected>Corto</option>
                                    <option>Medio</option>
                                    <option>Largo</option>
                                    <option>Sin identificar</option>
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
                                    <option selected>Corto</option>
                                    <option>Medio</option>
                                    <option>Largo</option>
                                    <option>Sin identificar</option>
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
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 

                        <button type="submit" class="btn btn-primary">Compartir la weed</button>
                    </form> 
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection