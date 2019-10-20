@extends('layouts.yogic')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            @include('error_success.error_success')
            <label>Add Product</label>
            <form method="post" action="{{ route('products.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Product name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Product name">
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                        @if(isset($categories) && count($categories) > 0)
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <input type="submit" value="Create" class="btn btn-primary">
            </form>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Product Lists</label>
                <ul>
                    @if(isset($products) && count($products) > 0)
                        @foreach($products as $Product)
                        <li><a href="{{route('products.edit', $Product->id)}}">{{$Product->name}}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
            {{$products->links()}}
        </div>  
    </div>
</div>
@endsection