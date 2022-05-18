<?php

/**
 * @author Fudio101
 * Date: 18/04/2022
 * Time: 10:14
 */
?>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Digital Signature</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="{{asset('assets/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fo ntawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet"
          href="{{asset('assets/https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
          href="{{asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('assets/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.min.css')}}">
    <!-- My css -->
    <link rel="stylesheet" href="{{asset('assets/css/user.css')}}">
</head>
<body>
<div class="wrapper">
    @include('layouts._sidebar')
    @yield('sign')
    @yield('verify')
    @yield('creat_key')
    @include('layouts._js')
</div>



@include('layouts._footer')
</body>

</html>
