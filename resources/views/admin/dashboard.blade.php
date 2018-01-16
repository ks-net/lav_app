<?php
/*
 *  File:dashboard.blade.php  encoding:UTF-8
 *  Created at 01-12-2018 (mm/dd/yyyy) 16:00:46
 *  Belongs to project:lav_app
 *  Copyright © 2018  @KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */
?>

@extends('layouts.admin')
@push('head-scripts')
@endpush


@section('content')

<div class="container">
    <div class="panel">
        <h3 class="page-header">admin dashboard</h3>

        <ul>
        @foreach ($routes as $route)
        <li>{{$route->uri}}</li>
        @endforeach
        </ul>

    </div>
</div>


@endsection

@push('bottom-scripts')
@endpush

