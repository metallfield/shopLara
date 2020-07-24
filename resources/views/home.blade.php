@extends('layouts.app')

@section('content')
<div class="container">
    <h1>home page</h1>                <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
            <form action="{{route('home')}}" method="GET" class="form-inline">
                <div class="form-group">
                    <label for="price_from"> price from </label>
                    <input type="text" name="price_from" id="price_from" class="mx-2 form-control" value="{{request()->price_from}}">
                </div>
                <div class="form-group">
                    <label for="  price_to"> price to </label>
                    <input type="text" name="price_to" id="price_to" class="mx-2 form-control" value="{{request()->price_to}}">
                </div>
                <button type="submit" class="mx-2 btn btn-outline-dark ">filter</button>
                <a href="{{route('home')}}" class="btn btn-warning mx-2">reset filter</a>
                @csrf
            </form>

    <div class="row justify-content-center">



                @foreach($products as $product)

                    <div class="col-3 m-4 border rounded">
                        <img src="{{Storage::url($product->image)}}" alt="" width="" height="100" class="w-100">
                        <h4><a href="{{route('productShow', [$product])}}">{{substr($product->name, 0 , 30)}}</a></h4>
                        @foreach($product->categories as $category)
                            <span class="badge badge-info">
                           <a href="{{route('category-show', [$category])}}" class="text-white"> {{$category->name}}</a>
                            </span>
                        @endforeach
                        <br><span class="text-success font-weight-bold">price: {{$product->price}}</span>
                    </div>
                @endforeach

</div>   </div>
    {{$products->links()}}
</div>
@endsection
