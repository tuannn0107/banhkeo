<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('title') - {{config('app.name')}}">
    <meta name="author" content="duongvalo">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/admin/favicon.png">
    <title>@yield('title') - {{config('app.name')}}</title>
	<link rel="canonical" href="{{request()->url()}}" />
    <link href="/css/admin/style.min.css" rel="stylesheet">
</head>
<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        @yield('content')
    </div>
    <script src="/js/admin/jquery.min.js"></script>
    <script src="/js/admin/popper.min.js"></script>
    <script src="/js/admin/bootstrap.min.js"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
    </script>
</body>
</html>
