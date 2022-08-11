<!DOCTYPE HTML>
@if( app()->getLocale()== 'en')
<html lang="{{ app()->getLocale() }}" >
@else
<html lang="{{ app()->getLocale() }}" dir="rtl"  >

@endif


<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<meta name="csrf-token" content="{{ csrf_token() }}" />

<title>Alaa Hariri</title>

@if( app()->getLocale()== 'en')

<link rel="stylesheet" type="text/css" href="{{ asset('ltr/styles/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ltr/styles/style.css') }}">
@else

<link rel="stylesheet" type="text/css" href="{{ asset('rtl/styles/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('rtl/styles/style.css') }}">

@endif
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('fonts/css/fontawesome-all.min.css') }}">    
<link rel="stylesheet" type="text/css" href="{{ asset('fonts/css/all.css') }}">    


<link rel="manifest" href="{{ asset('_manifest.json') }}" data-pwa-version="set_in_manifest_and_pwa_js">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo.png') }}">
<link rel="stylesheet"  type="text/css" href="{{ asset('rtl/styles/highlights/highlight_red.css') }}">
<link rel="stylesheet"  type="text/css" href="{{ asset('rtl/styles/highlights/highlight_dark.css') }}">
<link rel="icon" href="{{ asset('images/logo.png') }}" type="">
</head>

<body class="theme-light"  data-highlight="highlight_dark">

    <div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>
    
        <div id="page" >

            <!-- header and footer bar go here-->
          
           

            <div class="page-content" >
            <section >
                @yield('content')
            </section>

            <!-- footer and footer card-->
            <div class="footer" >
                <div class="footer card card-style mx-0 mb-0 " >
                    <a href="#" class="footer-title pt-4 mb-2">{{ __('text.Follow Us') }}</a>
                  
                   
                    <div class="text-center mb-3">
                        <a href="https://www.facebook.com/AlaaHaririarc/?eid=ARCewtqEQhgXPO4WsbLjy08zVfsQnquwt8a1eRhQnn7rm6QMAQ0cvY4apDo4a7zkWrZ81v9Zoe049Euf" class="icon icon-xs rounded-sm shadow-l me-1 bg-highlight"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/Alaahaririarc1" class="icon icon-xs rounded-sm shadow-l me-1 bg-highlight"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/alaahaririarc/?igshid=1dilwkib1rhqt" class="icon icon-xs rounded-sm shadow-l me-1 bg-highlight"><i class="fab fa-instagram"></i></a>

                    </div>
                </div>
                <div class="footer-card card shape-rounded bg-20" style="height:120px">
                    <div class="card-overlay bg-highlight opacity-90"></div>
                </div>
                    
            </div>  
        </div> 
    </div>

    
    @include('layouts.menu')


</body>

<script type="text/javascript" src="{{ asset('https://code.jquery.com/jquery-1.7.1.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('scripts/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('scripts/custom.js') }}"></script>
<script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js') }}"></script>
