<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="{{ $headers['description'] }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ $headers['image'] }}" />
    <meta property="og:title" content="{{ $headers['title'] }}" />
    <meta property="og:description" content="{{ $headers['description'] }}" />
    <meta property="og:url" content="{{ $headers['url'] }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@vegansfreedom.com" />
    <meta name="twitter:title" content="{{ $headers['title'] }}" />
    <meta name="twitter:description" content="{{ $headers['description'] }}" />
    <meta name="twitter:image" content="{{ $headers['image'] }}" />
    <meta name="yandex-verification" content="e31322b7cefd6aa1" />
    <meta name="msvalidate.01" content="2C526067C2E0CAE00D3DEA4A6FAA06F6" />
    <title>{{ $headers['pageTitle'] }}</title>
    <link rel="icon" href="/favicon.png">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/vf.css') }}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-151418896-1"></script>
    <script>
     window.dataLayer = window.dataLayer || [];
     function gtag(){dataLayer.push(arguments);}
     gtag('js', new Date());
     gtag('config', 'UA-151418896-1');
    </script>
</head>
<body>
@include('nav.menu')
<main role="main">
@include('nav.header')
@include('nav.sidebar')
    <div class="container-fluid"><!-- Main Grid Area Starts -->
        <div class="row justify-content-center p-0">
            <div class="col-lg-1 sidebar-lg-spacer"></div>
            <div class="offset-lg-1 col-lg-8 col-md-9 col-sm-12"><!-- Central Canvas -->
{{--@include('ali.ad')--}}
@yield('content')
            </div><!-- Central Canvas Ends -->
            <div class="col-lg-2 col-md-3 col-sm-12"><!-- Popular Area Starts -->
@include('nav.pop')
            </div><!-- Popular Area Ends -->
        </div><!-- Main Row Ends -->
    </div><!-- Main Grid Area Ends -->
</main>
@include('nav.footer')
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/vf.js') }}"></script>
<script src="{{ asset('js/sl.js') }}"></script>
</body>
</html>


































