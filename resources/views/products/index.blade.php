
@extends('layouts.app')

@section('title', 'Index Page')

@section('content')
    <div class="container">
        <div class="row">
        @foreach($products as $product)
                        <div class="col-sm-4">
                         <div class="card">
                             <div class="card-body text-center">
                                 <img class="card-img-top" src="{{asset($product->img)}}" width="100px" height="300px" alt="Card image cap">
                                 <br><br>
                                 <h2 class="card-title">{{$product->title}}</h2>
                                 <h5 class="card-title" align="center">Типі:{{$product->price}}</h5>
                                 <a href="{{route('products.show',$product->id)}}" class="btn btn-primary">Read More</a>
                             </div>
                         </div>
                        </div>
            @endforeach
        </div>
    </div>
@endsection
