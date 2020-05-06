@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form method="GET" action="{{ route('user.index') }}" id="buscador">
            <div class="row">
                <div class="form-group col">
                    <input type="text" id="search" class="form-control" />
                </div>
                <div class="form-group col btn-search">
                    <input type="submit" value="Buscar" class="btn btn-success"/>
                </div>
            </div>
        </form>
        <div class="col-md-8">
            @include('includes.show-message')
            @foreach($users as $user)
            <div class="card">
               
                <div class="card-header d-flex justify-content-between">
                    {{ $user->name }}

                </div> 

                <div class="card-body">
                 {{ $user->user_name }}
                </div>
                {{ \FormatTime::LongTimeFilter($user->created_at) }}   
            </div>
            
            <div class="clearfix"></div>
            @endforeach
            
            <hr>

            <div class="clearfix"></div>
                {{ $users->links() }}
            
        </div>
        
</div>
@endsection
