@extends('layouts.adm')
@section('title','Categories Page')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h3>CATEGORIES PAGE</h3>
    <form action="{{route('adm.categories.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="book">Name:</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label for="book">Code:</label>
            <input type="text" class="form-control" name="code">
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
