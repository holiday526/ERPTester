<!doctype html>
<html lang="en">
<head>
    @include('layout.partial.head')
</head>
<body id="page-top">
    <div id="wrapper">
        @include('layout.partial.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layout.partial.topbar')
                @yield('content')
            </div>
            @include('layout.partial.footer')
        </div>
    </div>
    @include('layout.partial.footer-scripts')
</body>
</html>