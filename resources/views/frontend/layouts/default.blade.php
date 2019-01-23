<!doctype html>
<html>
<head>
    @include('frontend.includes.head')
</head>
<body>
<div class="container">

    <header class="row">
        @include('frontend.includes.header')
    </header>

    <div id="main" class="row">

        @yield('content')

    </div>



</div>
</body>
</html>
