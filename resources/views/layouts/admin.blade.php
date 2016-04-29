<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title', 'Blog PHP - Admin')</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('assets/js/jquery-confirm2/css/jquery-confirm.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        <link href='https://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
        <meta name="_token" content="{{ csrf_token() }}"/>
    </head>
    <body>
    <header>
        <nav class="navbar navbar-inverse">@include('partials.nav')</nav>
    </header>
        <div class="main">

            @yield('h1')
            <div class="content">
                @yield('content')
            </div>
        </div>
        <footer></footer>
        <script src="http://code.jquery.com/jquery-2.2.2.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
        <script src="{{ asset('assets/js/jquery-confirm2/js/jquery-confirm.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
    </body>
</html>