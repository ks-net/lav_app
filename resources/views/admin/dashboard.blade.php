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


    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-cogs"></i> Admin Dashboard</div>
        <div class="panel-body">
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

