<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title', 'Hostel Paddy')</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no,
            width=device-width, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="title" content="HostelPaddy - Home">
  <meta name="author" content="@Eunit">
  <meta name="description" content=" ">
  <meta name="keywords" content=" ">
  <meta http-equiv="Content-Type" content="text/html">
  <meta name="theme-color" content="#0f4392">
  <link rel="manifest" href="{{ asset('main/manifest.json') }}">
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="#0f4392">
  <link rel="apple-touch-icon" href="{{ asset('main/img/logo.png') }}">
  <meta name="msapplication-TileColor" content="#0f4392">
  <meta name="msapplication-TileImage" content="{{ asset('main/img/logo.png') }}">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@hostelpaddy">
  <meta name="twitter:creator" content="@eunit99">
  <meta name="twitter:title" content=" ">
  <meta name="twitter:description" content=" ">
  <meta name="twitter:image" content="{{ asset('main/img/logo.png') }}">
  <meta name="apple-mobile-web-app-title" content="Add to Home">

  <!-- Open Graph data -->
  <meta property="og:title" content="HostelPaddy - Home">
  <meta property="og:url" content="https://hostelpaddy.com">
  <meta property="og:description" content=" ">
  <meta property="og:site_name" content=" ">
  <meta property="og:image" content="{{ asset('main/img/logo.png') }}">
  <meta name="og:locale" content="en_UK">
  <meta name="fb:admins" content="">
  <meta name="og:type" content="website">
  <meta property="article:publisher" content="https://facebook.com/hostelpaddy1">
  <meta property="og:image:secure_url" content="{{ asset('main/img/logo.png') }}">
  <meta property="og:image:width" content="512">
  <meta property="og:image:height" content="512">

  <!-- Favicons -->
  <link rel="apple-touch-icon-precomposed" href="{{ asset('main/img/logo.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('main/img/logo.png') }}">
  <link rel="mask-icon" href="{{ asset('main/img/logo.png') }}" color="#0f4392">
  <link rel="shortcut icon" href="{{ asset('main/img/logo.png') }}" type="image/x-icon">

  <!-- Site Verifications -->
  <meta name="google-site-verification" content="" />
  <meta name="google-analytics" content="UA-XXXXXX-X">

  <!-- Vendor scripts -->
  @notifyCss
  @livewireStyles

  <link rel="stylesheet" href="{{ asset('main/vendor/bootstrap-4.6.0-dist/css/bootstrap.min.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('main/vendor/animate/css/animate.min.css') }}">
  {{-- <link type="text/css" rel="stylesheet" href="{{ asset('main/vendor/reset/css/reset.min.css') }}"> --}}
  <link type="text/css" rel="stylesheet" href="{{ asset('main/vendor/normalize/css/normalize.min.css') }}">
  <link type="text/css" rel="stylesheet"
    href="{{ asset('main/vendor/open-iconic-master/font/css/open-iconic-bootstrap.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('main/css/agent/dropzone.min.css') }}" />

  <link rel="stylesheet" href="{{ asset('main/fileuploader/font/font-fileuploader.css') }}">
  <link rel="stylesheet" href="{{ asset('main/fileuploader/jquery.fileuploader.min.css') }}">
  <!-- Default Stylesheet -->
  <link type="text/css" href="{{ asset('main/css/student/styles.css') }}" rel="stylesheet" />
  @yield('styles')
</head>


<body>
  @include('layouts.agents.navigation')

  {{-- Print out message from controller --}}
  <x:notify-messages />
  {{-- Print out message from controller --}}


  @yield('content')


  @include('layouts.agents.footer')

  <!-- Vendor scripts -->
  @notifyJs
  @livewireScripts
  <script src="{{ asset('main/vendor/jquery/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('main/vendor/bootstrap-4.6.0-dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('main/vendor/fontawesome/d7644e187f.js') }}"></script>
  <script src="{{ asset('main/fileuploader/jquery.fileuploader.min.js') }}"></script>

  <script>
    let copyRight = document.getElementById("copyright"),
      date = new Date(),
      copyrightYear = date.getFullYear();
    copyRight.innerText = copyrightYear;
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('input.coverImage').fileuploader({
        // Options will go here
        limit: 1,
        maxSize: 3,
        fileMaxSize: 5,
        extensions: ['jpg', 'png', 'jpeg'],
        theme: 'thumbnails',
      });

      $('input.multipleImages').fileuploader({
        // Options will go here
        limit: 4,
        maxSize: 3,
        fileMaxSize: 14,
        extensions: ['jpg', 'png', 'jpeg'],
        theme: 'thumbnails',
      });
    });
  </script>

  @yield('script')
</body>

</html>