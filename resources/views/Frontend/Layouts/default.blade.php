<!DOCTYPE html>
<html lang="en">
    <head>
        @yield ('metaData')
        <link rel="icon" href="{{ url('Frontend/img/logo_title1.png') }}" type="image/gif" sizes="32x32">
       
        <script>
            var SiteUrl = '{{url("/")}}';
        </script>
        @includeif ('Frontend.Layouts._css_default')
        @yield('myCss')
    </head>
    <body id="page-top" class="index">
        @includeif ('Frontend.Layouts._menu')
        @yield('content')
        @includeif ('Frontend.Layouts._footer')
        @includeif ('Frontend.Layouts._js_default')
        @yield('myJs')

    </body>
</html>
