<!doctype html>
<html>
<head>
    @include('frontend.includes.head')
</head>
<body style="background: #ebebeb;">
<div class="container">

    <header class="row">
        @include('frontend.includes.header')
    </header>

    <div id="main" class="row">

        @yield('content')

    </div>

    <footer class="row">
        @include('frontend.includes.footer')
    </footer>


</div>
</body>
</html>
