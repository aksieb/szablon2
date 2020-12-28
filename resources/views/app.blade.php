<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sklep internetowy</title>

    <link rel='stylesheet' href={{ asset('/assets/css/bootstrap.min.css') }} />
    <link rel='stylesheet' href={{ asset('/assets/css/app.css') }} />
    <link rel='stylesheet' href={{ asset('/assets/css/shop-item.css') }} />
    @yield('stylesheets')
</head>

<body>
    <div class='container'>
        @yield('content')
    </div>

    <script src={{ asset('/assets/js/jquery.min.js') }}></script>
    <script src={{ asset('/assets/js/popper.min.js') }}></script>
    <script src={{ asset('/assets/js/bootstrap.bundle.min.js') }}></script>

    @yield('scripts')

    @include('front.components.footer')
</body>

</html>
