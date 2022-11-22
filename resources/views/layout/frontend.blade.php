<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>待辦事項 - @yield('title')</title>
</head>

<body>
    <div class="header container-fluid">
    @yield('header')
    </div>
    <div class="content container-fluid">
        @yield('content')
    </div>
    <div class="footer container-fluid">
        <div class="row composing">
            <h5>Todo List side project</h5>
        </div>
    </div>
</body>

</html>