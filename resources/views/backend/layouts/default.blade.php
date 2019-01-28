<!doctype html>
<html>
<head>
    @include('backend.includes.head')
</head>
<body>
@include('backend.includes.header')

<div class="page-content">

    <div class="row">
        <div class="page-container">
            @yield('content')

        </div>
    </div>

    <footer class="row">
        @include('backend.includes.footer')
    </footer>


</div>
</body>
</html>
