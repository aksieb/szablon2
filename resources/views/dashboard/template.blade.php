<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Panel administracyjny</title>

    <link rel='stylesheet' href={{ asset('/assets/css/bootstrap.min.css') }} />
    <link rel='stylesheet' href={{ asset('/assets/css/app.css') }} />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href={{ url('/dashboard') }}>Panel administracyjny</a>
    </nav>

    <div class="wrapper">
        <nav class="sidebar">
            @include('dashboard/sidebar')
        </nav>

        <div class="container content-box">
            @yield('right_box')
        </div>
    </div>

    <script src={{ asset('/assets/js/jquery.min.js') }}></script>
    <script src={{ asset('/assets/js/popper.min.js') }}></script>
    <script src={{ asset('/assets/js/bootstrap.bundle.min.js') }}></script>

    @yield('scripts')
</body>

</html>
