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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-rtl.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

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
                            <a class="nav-link" href="{{ route('index') }}">الرئيسية</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('shop') }}">التسوق</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">عنا</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact-us') }}">إتصل بنا</a>
                        </li>
                        <li class="nav-item">
                            <form class="d-flex" action="{{ route('search') }}" method="GET">
                                <input class="form-control mx-2" name="search" placeholder="إبحث عن منتجاتك">
                                <button type="submit" class="btn btn-outline-secondary" type="button">بحث</button>
                            </form>
                        </li>
                        <li class="nav-item pr-5 cart">
                            <a class="nav-link" href="{{ route('cart') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cart4" viewBox="0 0 16 16">
                                    <path
                                        d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
                                </svg>
                            </a>
                            <span class="count">0</span>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="pb-4">
            <div class="container msg"></div>
            @if (session('message'))
                <div class="container">
                    <div class="mt-5 alert alert-{{ session('alert-type') }} alert-dismissible fade show"
                        role="alert">
                        {{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
    <footer class="text-center py-2">
        <p class="pt-2">جميع الحقوق محفوظة &copy; الاماني للتسوق</p>
    </footer>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        $('.alert').fadeIn(5000, function() {
            $(this).fadeOut(5000);
        });

        function cartCount() {
            let _token = "{{ csrf_token() }}";

            $.ajax({
                type: 'get',
                url: "{{ route('cart-count') }}",
                data: {},
                success: function(data) {
                    $('.count').text(data);
                },
                error: function(reject) {

                },
            })
        }

        setTimeout(cartCount(), 1);

        $('.add-to-card').click(function(e) {

            e.preventDefault();

            let _token = "{{ csrf_token() }}";

            $.ajax({
                type: 'get',
                url: "{{ route('add-to-cart') }}",
                data: {
                    id: $(this).siblings('.id').val(),
                    name: $(this).siblings('.name').text(),
                    qty: $(this).siblings('.qty').val(),
                    price: $(this).siblings('.price').text(),
                    // _token: _token
                },
                success: function(data) {
                    if (data == false) {
                        $('.msg').append(
                            '<div class="mt-5 alert alert-danger alert-dismissible fade show" role="alert">لاتوجد كمية كافية لطلبك</div>'
                        );
                    }
                },
                error: function(reject) {

                },
            })

            cartCount();
        });
    </script>
</body>

</html>
