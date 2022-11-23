<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>待辦事項 - @yield('title')</title>
</head>

<body>
    <div class="header container-fluid">
        @yield('header')
    </div>
    <div class="content container-fluid">
        <div id="hideBG" class="hideBG"></div>
        @yield('content')
        @if ($errors->any())
        <div class="errorBlock">
            <ul>
                @foreach ($errors->all() as $error)
                <h5>
                    <li>{{ $error }}</li>
                </h5>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="footer container-fluid">
        <div class="row composing">
            <h5>Todo List side project</h5>
        </div>
    </div>
</body>

</html>
<script>
    function showAddForm() {
        var hideBG = document.getElementById("hideBG");
        var addForm = document.getElementById("addForm");
        addForm.classList.add("show");
        hideBG.style.display = "block";
        document.body.style.overflow = "hidden";
    }

    function hideAddForm() {
        var hideBG = document.getElementById("hideBG");
        var addForm = document.getElementById("addForm");
        addForm.classList.remove("show");
        hideBG.style.display = "none";
        document.body.style.overflow = "visible";
    }
</script>
