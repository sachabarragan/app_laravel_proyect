@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                    {{$user}}
                    </div>
                    <div class="card-body">
                        <a href="">
                            <div class="d-flex justify-content-center imgUnic">
                                <img src="{{ route('user.avatar', ['filename'=> $user->image ]) }}" alt="">
                            </div>
                        </a>
                        <div class="d-flex justify-content-left">
                            HACE CUANTO TIEMPO
                        </div>
                        <div class="d-flex justify-content-between">
                            <div> RAZA</div>
                            
                            <div>
                                AUTO/NO
                            </div>
                            <div>INDICA?</div>
                            <div>CBD: </div>
                            <div>THC: </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div></div>
                            <div>
                                VEG TIMA
                            </div>
                            <div>FLOW TIME</div>
                            <div></div>
                        </div>
                    </div> 
                </div>
                <div class="clearfix"></div> 
            
            </div>
        </div>
    </div>   
</div>
@endsection
