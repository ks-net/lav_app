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

    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            @if (Session::has('flash_message'))
            <div class="alert alert-success">
                <i class="fa fa-info-circle"></i> {{ Session::get('flash_message') }}
            </div>
            @endif

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading"><i class="fa fa-copy"></i> ALL POSTS LIST</div>
                <div class="panel-body">
                    <div class="well-sm">
                        <a href="{{route('adminmediaadd')}}" class="btn btn-success">
                            Add New Media
                            <i class="fa fa-plus-circle"></i>
                        </a>
                    </div>
                    @if (count($medias) === 0)
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i>
                        {{__('common.no_records_found')}}
                    </div>
                    @endif
                </div>

                @if (count($medias) > 0)
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
                            @sortablelink('name', trans('common.Name'))
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
                            <a href="{{asset($media->image)}}"  data-fancybox="group" data-caption="{{ $media->name }}">
                                <img class="img-thumbnail" src="{{asset($media->image_thumb) }}" alt="{{ $media->name }}" title="{{ $media->name }}"/>
                            </a>
                        </td>

                        <td  class="hidden-xs" style="border-left:1px dashed #ddd;max-width:640px;">
                            <div class="small text-success {{ $media->active === 1 ? '' : 'gray-out' }}">
                                {{ str_limit($media->name , config('settings.admin_title_trim') , '...') }}
                            </div>
                            <div style="font-style:italic;" class="small {{ $media->active === 1 ? '' : 'gray-out' }}">
                                {{ str_limit($media->image , '120', '...') }}
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="small">
                                <i class="material-icons {{ $media->active === 1 ? '' : 'gray-out' }}">
                                    {{ $media->active === 1 ? 'check' : 'visibility_off' }}
                                </i>
                            </span>
                        </td>
                        <td class="hidden-xs">
                            <span class="small">{{ $media->created_at }}</span>
                        </td>
                        <td class="hidden-xs">
                            <span class="small">{{ $media->updated_at }}</span>
                        </td>
                        <td class="text-center">
                            <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block"
                               href="{{route('adminmedialist')}}">
                                <i class="fa fa-edit"></i>
                            </a> &nbsp;
                            <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block"
                               href="{{route('adminmedialist')}}">
                                <i class="fa fa-eye"></i>
                            </a> &nbsp;

                            <form name="deletemedia{{ $media->id }}" action="{{ route('adminmediadelete', $media->id) }}" method="post" style="display:none;">
                                {!! csrf_field() !!}
                                {{ method_field('DELETE') }}
                            </form>
                            <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block"
                               onclick="if (confirm('{{__('common.confirm_delete_record')}}: {{ $media->id }}?')){ document.deletemedia{{ $media->id }}.submit(); }"
                               href="#"
                               title="{{__('common.Delete')}}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                @endif

                @if ($medias->total() > $medias->perPage())
                <div class="panel-footer">
                    {{ $medias->appends(\Request::except('page'))->render() }}
                </div>
                @endif

            </div> <!-- Panel End -->

        </div>
    </div>
@endsection


@push('bottom-scripts')

@endpush