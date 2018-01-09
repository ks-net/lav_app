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



@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            @if (Session::has('flash_message'))
            <div class="alert alert-success"><i class="fas fa-info-circle"></i> {{ Session::get('flash_message') }}</div>
            @endif

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading"><i class="fas fa-copy"></i> ALL POSTS LIST</div>
                <div class="panel-body">
                    <div class="well-sm">
                 <a href="{{url('post/create')}}" class="btn btn-success"> Create New Post <i class="fas fa-plus-circle"></i></a>
                 <a href="{{url('post/')}}" class="btn btn-default"> Posts Index Page <i class="fas fa-share"></i></a>
                    </div>
                    @if (count($posts) === 0)
                    <div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> I don't have any records!</div>
                    @endif
                </div>

                @isset ($posts)
                <!-- Table -->
                <table class="table" style="background:#fff;">
                    <tr class="bg-info">
                        <td class="hidden-xs">
                           @sortablelink('id', 'Id')
                        </td>
                        <td>
                           @sortablelink('title', 'Title', ['parameter' => 'down'])
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
                            Actions
                        </td>
                    </tr>
                    @foreach ($posts as $post)
                    <tr>
                        <td class="hidden-xs">
                            <span class="small">{{ $post->id }}</span>
                        </td>
                        <td style="border-left:1px dashed #ddd;max-width:640px;">
                            <span class="small {{ $post->active === 1 ? '' : 'gray-out' }}">{{ str_limit($post->title , '120', '...') }}</span>
                        </td>
                        <td class="text-center">
                            <span class="small"><i class="fas {{ $post->active === 1 ? 'fa-check' : 'fa-ban gray-out' }}"></i></span>
                        </td>
                        <td class="hidden-xs">
                            <span class="small">{{ $post->created_at }}</span>
                        </td>
                        <td class="hidden-xs">
                            <span class="small">{{ $post->updated_at }}</span>
                        </td>
                        <td class="text-center">
                            <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block" href="{{url('post/'.$post->seotitle)}}"><i class="fas fa-edit"></i></a> &nbsp;
                             <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block" href="{{url('post/'.$post->seotitle)}}"><i class="fas fa-eye"></i></a> &nbsp;
                            <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block" href="{{url('post/'.$post->seotitle)}}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                @endisset

                <div class="panel-footer">
                    {{ $posts->appends(\Request::except('page'))->render() }}
                </div>

            </div> <!-- Panel End -->


        </div>
    </div>
</div>
@endsection