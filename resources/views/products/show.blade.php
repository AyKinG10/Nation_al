@extends('layouts.app')

@section('title', 'Home Page')

@section('content')




    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                @if($avgRating!=0)
                    <h3>Оқырмандар бағасы:  {{$avgRating}}/5</h3>
                @endif
                <form action="{{route('products.like',$product->id)}}" method="post">
                    @csrf
                    <button class="btn btn-outline-danger" type="submit"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                        </svg>Добавить в избранные <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                        </svg></button>
                </form>
                    @if($mySubscribe!=0)
                    <div id="wrapper">
                        <div id="container" style="width: auto;height:auto">
                            <section class="open-book">
                                <header>
                                    <h1>{{$products->price}}</h1>
                                </header>
                                <article>
                                    <h5 class="chapter-title">{{$products->title}}</h5>
                                <p>{{$products->type}}</p>
                                </article>
                                <footer>
                                    <ol id="page-numbers">
                                        <li>1</li>
                                        <li>2</li>
                                    </ol>
                                </footer>
                            </section> <div class="btn-group" role="group" aria-label="Basic example" >
                                <a href="{{route('products.edit',[$products->id])}}"><button type="button" class="btn btn-primary">Edit</button></a>
                                @can('delete',$products)
                                    <form action="{{route('$products.destroy',$products->id)}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger"  type="submit">Delete</button>
                                    </form>
                                @endcan<br>
                            </div>
                        </div>
                        @endcan
                    </div>
                </div>
            @else
                <br>
                <h1 align="center">Кітапты оқу үшін тіркеліңіз <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                    </svg></h1>
            @endif
            <br>
        </div>


            </div>

                <br><br>
                <form action="{{route('comment.store')}}" method="post">
                    @csrf
                    <div class="form-group" style="margin-top: 10px;">
                        <input type="hidden" value="{{$products->id}}" name="product_id">
                        Comment: <textarea class="form-control" name="content" id="" cols="30" rows="4" required></textarea><br>

                        <button type="submit" class="btn btn-primary">Add comment</button>
                    </div>
                </form>
                <br>
                <form action="{{route('products.rate',$products->id)}}" method="post">
                    @csrf
                    <div class="card" style="width: 350px">
                        <div class="card-body">
                    <p style="font-family: 'Times New Roman';font-size: 25px">Бағалап кетіңіз: </p>
                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" style="text-align:center;width: 150px;height: 45px"  name="rating">
                                @for($i=0;$i<=5;$i++)
                                    <option {{$myRating==$i ? 'selected' : ''}} value="{{$i}}">
                                        {{$i==0 ? 'Not rated' : $i}}
                                    </option>
                                @endfor
                            </select></div>
                        <button class="btn btn-outline-success"  type="submit">Rate</button>
                    </div>
                    <br>
                </form>
                <h2 style="text-align: left;font-family: Broadway" >Пікірлер: </h2>

                <div class="row">
                    @foreach($products->comments as $comment)
                  {{--      <h5>{{$comment->content}}</h5>
                    <small>{{$comment->user->name}}</small>--}}
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <p class="card-title" style="text-align: left">Пікір қалтырушы: {{$comment->user->name}}</p>
                                <p style="font-weight: bold" align="center"> {{$comment->content}}</p>
                        @can('delete',$comment)
                                    <form action="{{route('comment.destroy',$comment->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-primary" type="submit">DELETE</button>
                                    </form>
                            </div>
                        </div>
                    </div>@endcan
                    @endforeach
                    </div>
            </div>
        </div>
    </div>
@endsection

