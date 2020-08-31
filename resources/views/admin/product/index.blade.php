@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="4">
                            <a type="button" class="btn btn-success" href="{{route('product.create')}}">Create</a>
                        </th>
                    </tr>
                </thead>
                <thead>
                @if($products->count())
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr class="table-success">
                                <th scope="row" class="align-middle text-center">
                                    <img src="{{asset($product->image)}}" alt="{{$product->name}}" style="width: 100px; height:100px;">
                                    <br>
                                    {{$product->name}}
                                </th>
                                <td class="align-middle text-center">
                                {{$product->price}}
                                </td>
                                <td>
                                {{ Str::limit($product->description, 200) }}
                                <a href="{{route('product.edit',$product->id)}}">details</a>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{route('product.edit',$product->id)}}">
                                            Edit
                                        </a>
                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deleteModal" onclick="handleDelete('{{$product->id}}')">
                                            Delete
                                        </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <th colspan="4">
                                <h1 class="display-5">
                                    No product to display
                                </h1>
                            </th>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                   <form action="" method="POST" id="deleteProductForm">
                       @csrf
                       @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure to delete this product?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
   <script>
        function handleDelete(id){
            var form = document.getElementById('deleteProductForm');
            form.action = '/product/' + id;
            $('#deleteModal').modal('show');
        }
   </script>
@endsection