@extends('layouts.app')

@section('title', 'Create Page')

@section('content')

    {{--    @if($errors->any())--}}
    {{--        <div class="alert alert-danger">--}}
    {{--            <ul>--}}
    {{--                @foreach($errors->all() as $error)--}}
    {{--                    <li>{{$error}}</li>--}}
    {{--                @endforeach--}}
    {{--            </ul>--}}
    {{--        </div>--}}
    {{--    @endif--}}

    @can('create',App\Models\Product::class)
        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-5">

                        <div class="form-group" style="margin-top: 10px;">

                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title">
                            @error('title')
                            <div class="alert alert-danger ">{{ $message  }}</div>
                            @enderror <br>
                            <select class="form-control form-control-lg mt-3 @error('category_id') is-invalid @enderror" name="category_id" id="">
                                @foreach($categories as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                                @error('category_id')
                                <div class="alert alert-danger ">{{ $message  }}</div>
                                @enderror
                            </select><br>
                            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Price">
                            @error('author')
                            <div class="alert alert-danger ">{{ $message  }}</div>
                            @enderror
                            <input type="text" name="type" class="form-control @error('type') is-invalid @enderror" placeholder="Type">
                            @error('content')
                            <div class="alert alert-danger ">{{ $message }}</div>
                            @enderror
                            <label for="imgInput" class="form-control">Image</label>
                            <input type="file" class="form-control @error('img') is-invalid @enderror"  id="imgInput" name="img">
                            @error('img')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                            </div>
                            <button class="btn btn-primary form-control"  style="margin-top: 20px"  type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    @endcan
@endsection
