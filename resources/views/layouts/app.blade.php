<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{asset('css/bdzh.css')}}" rel="stylesheet" />
    <link href="{{asset('css/sq.css')}}" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                NATION-Al
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>



            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @isset($categories)
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('products.index')}}">All Products</a>
                        </li>
                        <li class="nav-item">
                            @can('create',App\Models\Product::class)
                                <a class="nav-link" href="{{route('products.create')}}"><p style="font-weight: bold">Create product</p></a>
                        @endcan


                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link">Categories</a>
                                <div class="dropdown-content">
                                    @foreach($categories as $cat)
                                        <a href="{{route('products.category',$cat->id)}}">{{$cat->name}}</a>
                                    @endforeach
                                </div>
                            </div>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('products.favorite')}}">My favorites</a>
                        </li>
                        @endisset
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @can('viewAny',App\Models\Book::class)
                            <a class="nav-link" href="{{route('adm.users.index')}}"><p style="font-weight: bold">Admin Panel</p></a>
                        @endcan
                        @can('view',App\Models\Book::class)
                            <a class="nav-link" href="{{route('adm.categories.index')}}"><p style="font-weight: bold">Moderator Panel</p></a>
                        @endcan
                        @guest
                            @if (Route::has('login.form'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register.form'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register.form') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
            </div>
        </div>
    </nav>

    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <main class="py-4">
        @yield('content')
    </main>
    <footer class="text-center text-white" style="background: #313131">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Google -->
                <a class="btn btn-outline-light btn-floating m-1" href="https://mail.google.com/" role="button"
                ><i class="fab fa-google">Gmail</i
                    ></a>
                <!-- Instagram -->
                <a class="btn btn-outline-light btn-floating m-1" href="https://www.instagram.com/_ayanserikkan_/" role="button"
                ><i class="fab fa-instagram">Instagram</i
                    ></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-2" style="background-color: wheat;">
            <p style="color: #111111">Nation_al <br>
                © 2022-2023</p>
        </div>
    </footer>
</div>
</body>
</html>
