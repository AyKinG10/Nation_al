@extends('layouts.app')

@section('title', 'Favorite Page')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($products as $product)
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img class="card-img-top" src="{{$product->img}}" width="100px" height="300px" alt="Card image cap">
                            <br><br>
                            <h2 class="card-title">{{$product->title}}</h2>
                            <h5 class="card-title" align="center">Құны: {{$product->price}}</h5>
                        </div>
                    </div>
                    <form action="{{route('products.likee',$product->id)}}" method="post" >
                        @csrf
                        <button class="btn btn-danger"  type="submit">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
