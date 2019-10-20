@extends('layouts.yogic')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('error_success.error_success')
            <div class="form-group">
                <label>Categoty lists:</label>
                <ul>
                    @if(isset($categories) && count($categories) > 0)
                        @foreach($categories as $category)
                        <li><input class="product-category" type="checkbox" value="{{ $category->id }}">{{$category->name}}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
            {{$categories->links()}}
        </div>
        <div class="col-md-4">
            <div class="products">
                <label for="">Products by category:</label>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('js/yogic.js') }}" defer></script>
@endpush
