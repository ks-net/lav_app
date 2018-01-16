<?php
/*
 *  File:admin.blade.php  encoding:UTF-8
 *  Created at 01-12-2018 (mm/dd/yyyy) 15:10:33
 *  Belongs to project:lav_app
 *  Copyright © 2018  @KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */
?>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">



        <!-- Styles -->
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

        @stack('head-scripts')

    </head>
    <body>
        <div id="app" >

            @include('elements.admin.menu')

            <!-- Start Content -->
            @yield('content')
            <!-- Content End -->

        </div> <!-- APP END -->

        <!-- Scripts -->
        <script src="{{ asset('js/admin.js') }}"></script>

        @stack('bottom-scripts')
        <!-- Scripts End -->

    </body>
</html>
