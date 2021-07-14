<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/magicslideshow.css') }}" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-rtl.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                الاصناف
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('categories.create') }}">إضافة صنف</a>
                                <a class="dropdown-item" href="{{ route('categories') }}">عرض الاصناف</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                المنتجات
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('products.create') }}">إضافة منتج</a>
                                <a class="dropdown-item" href="{{ route('products') }}">عرض المنتجات</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">المبيعات</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto" style="margin-left: 0 !important;">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
        <main class="py-4">
            @if (session('message'))
                <div class="container">
                    <div style="position:rellative" class="alert alert-{{ session('alert-type') }}" role="alert">
                        {{ session('message') }}
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/magicslideshow.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        $('.add-to-cart-button').click(function() {
            addItemToCart($(this).data('id').value, 5). // paste your id product number
        });

        function addItemToCart(id, qty) {
            data = {
                "id": id,
                "quantity": qty
            }

            jQuery.ajax({
                type: 'POST',
                url: '/cart/add.js',
                data: data,
                dataType: 'json',
                success: function(data) {
                    document.documentElement.dispatchEvent(new CustomEvent('cart:refresh', {
                        bubbles: true //this code is for prestige theme, is to refresh the cart
                    }));
                }
            });
            document.documentElement.dispatchEvent(new CustomEvent('cart:refresh', {
                bubbles: true // same code for prestige theme
            }));
        }
    </script>
</body>

</html>
