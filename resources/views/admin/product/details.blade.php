@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card mb-3">
        <img class="card-img-top" src="{{asset($product->image)}}" alt="{{$product->name}}">
            <div class="card-body">
                <h5 class="card-title">{{$product->name}}</h5>
                <p class="card-text">{{$product->description}}</p>
                <p class="card-text"><small class="text-muted">{{$product->updatted_at}}</small></p>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
