
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{route('products.update',$products->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group" style="margin-top: 20px;">
                        <input type="text" class="form-control" name="title" value="{{$products->title}}">
                        <input type="text" class="form-control" name="price" value="{{$products->price}}">
                        <input type="file" class="form-control" name="file" value="{{$products->img}}">
                        <select class="form-control form-control-lg mt-3"  name="category_id" id="">
                            @foreach($categories as $cat)
                                <option @if($cat->id==$products->category_id) selected @endif value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select><br>
                        <input type="text" class="form-control" name="type" value="{{$products->type}}">
                        <button class="btn btn-primary form-control mt-3" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
