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

@extends('layouts.admin')

@section('breadcrumbs')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-list-alt"></i> <a href="{{route('admin')}}">{{__('common.admin_dashboard')}}</a></li>
    <li class="breadcrumb-item active">@lang_ucf('common.settings')</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col">

        <!-- flash Messages Start -->
        @if (Session::has('flash_message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-info-circle"></i> {{ Session::get('flash_message') }}
        </div>
        @endif
        @if (Session::has('flash_message_success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-check-circle"></i> {{ Session::get('flash_message_success') }}
        </div>
        @endif
        @if (Session::has('flash_message_warning'))
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-exclamation-triangle"></i> {{ Session::get('flash_message_warning') }}
        </div>
        @endif
        @if (Session::has('flash_message_error'))
        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ Session::get('flash_message_error') }}</div>
        @endif
        <!-- flash Messages End -->

        <div class="card">
            <div class="card-header"><i class="fa fa-cogs"></i> @lang_ucf('common.settings')</div>
            <div class="card-body">

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
                        <ul class="mb-0 pl-2">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {!! csrf_field() !!}
                    {{ method_field('PUT') }}
                    @foreach ($settings as $setting)
                    <div class="form-group">
                        <label class="{{ $errors->has($setting->name) ? ' text-danger' : '' }}" for="{{$setting->name}}">{{$setting->name}}</label>
                        <input type="text" class="form-control{{ $errors->has($setting->name) ? ' is-invalid' : '' }}" id="{{$setting->name}}" name="{{$setting->name}}"  value="{{old($setting->name , $setting->value)}}">
                        @if(Lang::has('common.'.$setting->name.'_help'))
                        <small class="form-text text-muted">@lang('common.'.$setting->name.'_help')</small>
                        @endif
                        @if($errors->has($setting->name))
                        <small class="form-text{{ $errors->has($setting->name) ? ' text-danger' : '' }}">{{ $errors->first($setting->name) }}</small>
                        @endif
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
                <!-- END  FORM  -->
            </div>

            <div class="card-footer">
                ...
            </div>
        </div> <!-- Card  End -->

    </div>
</div>
@endsection
