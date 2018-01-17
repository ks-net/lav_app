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
    <li><i class="fa fa-list-alt"></i> <a href="{{route('admin')}}">{{__('general.admin-dashboard')}}</a></li>
    <li class="active">{{__('general.list-all-posts')}}</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-md-offset-0">

        @if (Session::has('flash_message'))
        <div class="alert alert-success"><i class="fa fa-info-circle"></i> {{ Session::get('flash_message') }}</div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-copy"></i> {{__('general.list-all-posts')}}</div>
            <div class="panel-body">
                <div class="well-sm">
                    <a href="{{route('adminpostcreate')}}" class="btn btn-success"> Create New Post <i class="fa fa-plus-circle"></i></a>
                </div>
                @if (count($posts) === 0)
                <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> {{__('general.no-records-found')}}</div>
                @endif
            </div>

            @if (count($posts) > 0)
            <!-- Table -->
            <table class="table table-hover table-condensed" style="background:#fff;">
                <tr class="bg-info">
                    <td class="hidden-xs">
                        @sortablelink('id', 'Id')
                    </td>
                    <td>
                        @sortablelink('title', 'Title')
                    </td>
                    <td class="text-center">
                        @sortablelink('active')
                    </td>
                    <td class="hidden-xs">
                        @sortablelink('created_at')
                    </td>
                    <td class="hidden-xs">
                        @sortablelink('updated_at')
                    </td>
                    <td class="text-center">
                        Actions.
                    </td>
                </tr>
                @foreach ($posts as $post)
                <tr>
                    <td class="hidden-xs">
                        <span class=" ">{{ $post->id }}</span>
                    </td>
                    <td style="border-left:1px dashed #ddd;max-width:640px;">
                        <span class="  {{ $post->active === 1 ? '' : 'gray-out' }}">{{ str_limit($post->title , config('settings.admin_title_trim') , '...') }}</span>
                    </td>
                    <td class="text-center">
                        <span class=" "><i class="fa  {{ $post->active === 1 ? 'fa-check' : 'fa-eye-slash gray-out' }}"></i></span>
                    </td>
                    <td class="hidden-xs">
                        <span class="small">{{ $post->created_at }}</span>
                    </td>
                    <td class="hidden-xs">
                        <span class="small">{{ $post->updated_at }}</span>
                    </td>
                    <td class="text-center">

                        <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block" href="{{ route('adminpostedit', $post->id) }}"><i class="fa fa-pencil"></i></a> &nbsp;
                        <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block" href="{{url('post/'.$post->seotitle)}}"><i class="fa fa-eye"></i></a> &nbsp;
                        <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block" onclick="return confirm('{{__('general.confirm-delete-record')}}: {{ $post->id }}?')" href="{{ route('adminpostdelete', $post->id) }}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>
            @endif

            @if ($posts->total() > $posts->perPage())
            <div class="panel-footer">
                {{ $posts->appends(\Request::except('page'))->render() }}
            </div>
            @endif

        </div> <!-- Panel End -->

    </div>
</div>
@endsection