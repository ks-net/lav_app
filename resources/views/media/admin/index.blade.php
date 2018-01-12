<?php

/*
 *  File:media.blade.php  encoding:UTF-8
 *  Created at 01-10-2018 (mm/dd/yyyy) 23:52:10
 *  Belongs to project:lav_app
 *  Copyright © 2018  @KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */
?>


@extends('layouts.admin')

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
                 <a href="{{route('adminmediaadd')}}" class="btn btn-success"> Add New Media <i class="fas fa-plus-circle"></i></a>
                    </div>
                    @if (count($medias) === 0)
                    <div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> I don't have any records!</div>
                    @endif
                </div>

                @isset ($medias)
                <!-- Table -->
                <table class="table" style="background:#fff;">
                    <tr class="bg-info">
                        <td class="hidden-xs">
                           @sortablelink('id', 'Id')
                        </td>
                        <td>
                           Image
                        </td>
                        <td class="hidden-xs">
                           @sortablelink('name', trans('general.Name'))
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
                    @foreach ($medias as $media)
                    <tr>
                        <td class="hidden-xs">
                            <span class="small">{{ $media->id }}</span>
                        </td>
                        <td class="">
                            <a href="{{asset($media->image)}}"  data-fancybox="group" data-caption="{{ $media->name }}"><img class="img-thumbnail" src="{{asset($media->image_thumb) }}" alt="{{ $media->name }}" title="{{ $media->name }}"/></a>
                        </td>

                        <td  class="hidden-xs" style="border-left:1px dashed #ddd;max-width:640px;">
                            <div class="small text-success {{ $media->active === 1 ? '' : 'gray-out' }}">{{ str_limit($media->name , '120', '...') }}</div>
                            <div style="font-style:italic;" class="small {{ $media->active === 1 ? '' : 'gray-out' }}">{{ str_limit($media->image , '120', '...') }}</div>
                        </td>
                        <td class="text-center">
                            <span class="small"><i class="fas {{ $media->active === 1 ? 'fa-check' : 'fa-ban gray-out' }}"></i></span>
                        </td>
                        <td class="hidden-xs">
                            <span class="small">{{ $media->created_at }}</span>
                        </td>
                        <td class="hidden-xs">
                            <span class="small">{{ $media->updated_at }}</span>
                        </td>
                        <td class="text-center">
                            <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block" href="{{url('media/'.$media->id)}}"><i class="fas fa-edit"></i></a> &nbsp;
                             <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block" href="{{url('media/'.$media->id)}}"><i class="fas fa-eye"></i></a> &nbsp;
                            <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block" href="{{url('media/'.$media->id)}}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                @endisset

                <div class="panel-footer">
                    {{ $medias->appends(\Request::except('page'))->render() }}
                </div>

            </div> <!-- Panel End -->


        </div>
    </div>
</div>
@endsection


@push('bottom-scripts')

@endpush