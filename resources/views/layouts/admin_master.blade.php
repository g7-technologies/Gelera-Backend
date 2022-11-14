<!DOCTYPE html>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <title>Gelera | Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('public/images/logo.png') }}">

        <link href="{{ asset('public/assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">
        <!-- DataTables -->
        <link href="{{ asset('public/assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('public/assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" /> 
        <!-- App css -->
        <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    </head>

    <body>

        @include('includes.topbar')
        
        <div class="page-wrapper">

        @include('includes.sidebar')

        <!-- Page Content-->
        <div class="page-content">
            @yield('content')

        @include('includes.footer')
