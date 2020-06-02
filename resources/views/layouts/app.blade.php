
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/boxicons.min.css') }}" rel="stylesheet">
{{--    <link href="{{ asset('resources/css/boxicons.min.css') }}" rel="stylesheet">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

</head>
<body>

    <div id="app" >
        <div style="height: 87px">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm  fixed-top " >
            <div class="container">
                <a class="navbar-brand d-flex" href="{{ url('/') }}">
                    <div ><img style="height: 60px;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5HDYjCCz-dPxq5ZuIb3UviiBnZ3rBX5I8u6nOWOaD5Yd6ScEokA&s"></div>
                    <div class="pt-3">myGram</div>


                </a>





                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <div class="d-flex ">


                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="profile/{{$user->profile->id ?? ''}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->username }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <a class="dropdown-item" href="{{route('profile.update', auth()->user()->id)}}">
                                            Profile

                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>

                </div>
            </div>
        </nav>
        </div>
        <main class="py-4">
            @yield('content')

        </main>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script type="text/javascript" src="resources/js/jquery.js"></script>



    @yield('extrajs')
</body>
</html>
