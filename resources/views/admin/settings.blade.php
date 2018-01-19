<?php
/*
 *  File:settings.blade.php  encoding:UTF-8
 *  Created at 01-17-2018 (mm/dd/yyyy) 17:21:03
 *  Belongs to project:lav_app
 *  Copyright © 2018  @KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */
?>

<?php
/*
 *  File:post.list.blade.php part-of-project:lav_app encoding:UTF-8
 *  Last Modified at 7 Ιαν 2018 3:11:29 πμ.
 *  NOTE: COMMERCIAL LICENSE.. !
 *  Copyright 2018 KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */
?>

@extends('layouts.admin')

@section('breadcrumbs')
<ol class="breadcrumb">
    <li><i class="fa fa-list-alt"></i> <a href="{{route('admin')}}">{{__('common.admin_dashboard')}}</a></li>
    <li class="active">@lang_ucf('common.settings')</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-md-offset-0">

        @if (Session::has('flash_message'))
        <div class="alert alert-success"><i class="fa fa-info-circle"></i> {{ Session::get('flash_message') }}</div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-cogs"></i> @lang_ucf('common.settings')</div>
            <div class="panel-body">

                @if (count($settings) === 0)
                <div class="alert alert-warning">
                    <i class="fa fa-exclamation-triangle"></i> &nbsp;
                    {{__('common.no_records_found')}}
                </div>
                @endif

                <!-- START ADD FORM  -->
                <form action="{{route('adminsettingsupdate')}}" method="post" >

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {!! csrf_field() !!}
                    {{ method_field('PUT') }}
                    @foreach ($settings as $setting)
                    <div class="form-group{{ $errors->has($setting->name) ? ' has-error' : '' }}">
                        <label for="{{$setting->name}}">{{$setting->name}}</label>

                        <input type="text" class="form-control" id="{{$setting->name}}" name="{{$setting->name}}"  value="{{old($setting->name , $setting->value)}}">

                        @if($errors->has('$setting->name'))
                        <span class="help-block">{{ $errors->first('$setting->name') }}</span>
                        @endif
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
                <!-- END  FORM  -->
            </div>

            <div class="panel-footer">
                ...
            </div>
        </div> <!-- Panel End -->

    </div>
</div>
@endsection
