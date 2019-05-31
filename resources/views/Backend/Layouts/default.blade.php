<!DOCTYPE html>
<html>
    <head>
        <title>  @yield('title') </title>
        <link rel="icon" href="{{ url('Frontend/img/logo_title1.png') }}" type="image/gif" sizes="32x32">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @yield('page_header')
        <script>
            var SiteUrl = '{{url("/")}}';
            var headingNotifi = {
                success: '{!! trans("confirm.success")!!}',
                failue: '{!! trans("confirm.failue")!!}',
                warning: '{!! trans("confirm.warning") !!}'
            };
            var messageNotifi = {
                success: '{!! trans("confirm.message_success") !!}',
                failue: '{!! trans("confirm.message_failue")!!}',
                warning: '{!! trans("confirm.message_warning") !!}'
            };
            var ConfirmBtn = {
                confirm: '{!! trans("confirm.btn_confirm")!!}',
                cancel: '{!! trans("confirm.btn_cancel")!!}',
            };
            var textConfirm = '{!! trans("confirm.text_confirm") !!}';
        </script>
        @includeIf ('Backend.Layouts._css_default')
        @includeIf ('Backend.Layouts._css')
        @stack('myCss')
        @includeIf ('Backend.Layouts._angular')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body ng-app="ngApp" ng-cloak class="{{ Auth::user()->is_customer == 1 ? 'sidebar-dark' : '' }}">
        <div class="container-scroller">
            @includeIf ('Backend.Layouts._header')
            <div class="container-fluid page-body-wrapper">
                @includeIf ('Backend.Layouts._menu')
                <div class="main-panel">
                    @yield('content')
                    @includeIf ('Backend.Layouts._footer')
                    @includeIf ('Backend.Layouts._js_default')
                    @includeIf ('Backend.Layouts._js')
                    @stack('myJs')
                </div>
            </div>
        </div>
    </body>
</html>
