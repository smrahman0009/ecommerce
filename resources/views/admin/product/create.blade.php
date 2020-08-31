@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    {{isset($product) ? 'Edit' : 'Create'}}
                </div>
                <div class="card-body">
                <form action="{{isset($product)? route('product.update',$product->id) : route('product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(isset($product))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" value="{{isset($product) ? $product->name : ''}}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if(isset($product))
                        <div class="form-group">
                            <img src="{{asset($product->image)}}" alt="" style="width: 70%; height: 70%;">
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" id="image">
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="price">Price</label>
                          <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" placeholder="Price" value="{{isset($product) ? $product->price : ''}}">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                            <textarea name="description" id="description" cols="5" rows="10" class="form-control  @error('description') is-invalid @enderror">
                               {{isset($product) ? $product->description : ''}}
                            </textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="{{isset($product) ? 'Update' : 'Create'}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
