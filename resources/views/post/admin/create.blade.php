<?php
/*
 *  File:postadd.blade.php part-of-project:lav_app encoding:UTF-8
 *  Last Modified at 29 Δεκ 2017 9:18:26 μμ.
 *  NOTE: COMMERCIAL LICENSE.. !
 *  Copyright 2017 KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */
?>

@extends('layouts.admin')

@section('breadcrumbs')
<ol class="breadcrumb">
    <li><i class="fa fa-list-alt"></i> <a href="{{route('admin')}}">@lang_ucw('common.admin_dashboard')</a></li>
    <li><a href="{{route('adminpostlist')}}">@lang_ucw('common.post_list')</a></li>
    <li class="active">@lang_ucw('common.create_new_post')</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-md-offset-0">

        @if (Session::has('flash_message'))
        <div class="alert alert-info"><i class="fas fa-info-circle"></i> {{ Session::get('flash_message') }}</div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-plus-square"></i> @lang_ucw('common.create_new_post')</div>

            <div class="panel-body">
                <div class="well-sm text-right">
                    <a href="{{route('adminpostlist')}}" class="btn btn-danger">@lang_ucf('common.back_to') @lang_ucw('common.post_list') <i class="fa fa-sign-out"></i></a>
                </div>
                <!-- START ADD FORM  -->
                <form action="{{route('adminpostcreate')}}" method="post" enctype="multipart/form-data">

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
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title">@lang_ucw('common.title')</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="@lang_ucw('common.title')" value="{{ old('title') }}">
                        @if($errors->has('title'))
                        <span class="help-block">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('seotitle') ? ' has-error' : '' }}">
                        <label for="seotitle">@lang_ucw('common.seotitle')</label>
                        <input type="text" class="form-control" id="seotitle" name="seotitle" placeholder="@lang_ucw('common.seotitle')" value="{{ old('seotitle') }}">
                        @if($errors->has('seotitle'))
                        <span class="help-block">{{ $errors->first('seotitle') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('main_img') ? ' has-error' : '' }}">
                        <label for="main_img">@lang_ucw('common.main_image')</label>
                        <input type="file" name="main_img" id="main_img" value="{{ old('main_img') }}">
                        @if($errors->has('main_img'))
                        <span class="help-block">{{ $errors->first('main_img') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('sortdesc') ? ' has-error' : '' }}">
                        <label for="sortdesc">@lang_ucw('common.sortdesc')</label>
                        <textarea class="form-control" id="sortdesc" name="sortdesc" placeholder="@lang_ucw('common.sortdesc')">{{ old('sortdesc') }}</textarea>
                        @if($errors->has('sortdesc'))
                        <span class="help-block">{{ $errors->first('sortdesc') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('postbody') ? ' has-error' : '' }}">
                        <label for="postbody">@lang_ucw('common.text_area')</label>
                        <textarea class="form-control" id="postbody" name="postbody" placeholder="@lang_ucw('common.text_area')">{{ old('postbody') }}</textarea>
                        @if($errors->has('postbody'))
                        <span class="help-block">{{ $errors->first('postbody') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="tags">@lang_ucw('common.tags')</label>
                        <input type="text" name="tags" id="tags" value="{{ old('tags') }}">
                        <span class="help-block">@lang('common.tags_help')</span>
                        @if($errors->has('tags'))
                        <span class="help-block">{{ $errors->first('tags') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('metatitle') ? ' has-error' : '' }}">
                        <label for="metatitle">@lang_ucw('common.metatitle')</label>
                        <input type="text" class="form-control" id="metatitle" name="metatitle" placeholder="@lang_ucw('common.metatitle')" value="{{ old('metatitle') }}">
                        <span class="help-block">@lang('common.metatitle_help')</span>
                        @if($errors->has('metatitle'))
                        <span class="help-block">{{ $errors->first('metatitle') }}</span>
                        @endif
                    </div>
                        <div class="form-group{{ $errors->has('metadesc') ? ' has-error' : '' }}">
                        <label for="metadesc">@lang_ucw('common.metadesc')</label>
                        <textarea class="form-control" id="metadesc" name="metadesc" placeholder="@lang_ucw('common.metadesc')">{{ old('metadesc') }}</textarea>
                        <span class="help-block">@lang('common.metadesc_help')</span>
                        @if($errors->has('metadesc'))
                        <span class="help-block">{{ $errors->first('metadesc') }}</span>
                        @endif
                    </div>
                       <div class="form-group{{ $errors->has('metakeywords') ? ' has-error' : '' }}">
                        <label for="metakeywords">@lang_ucw('common.metakeywords')</label>
                        <input type="text" class="form-control" id="metakeywords" name="metakeywords" placeholder="@lang_ucw('common.metakeywords')" value="{{ old('metakeywords') }}">
                        <span class="help-block">@lang('common.metakeywords_help')</span>
                        @if($errors->has('metakeywords'))
                        <span class="help-block">{{ $errors->first('metakeywords') }}</span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-success">@lang_ucw('common.save')</button>
                </form>
                <!-- END ADD FORM  -->

            </div>
        </div> <!-- panel END -->

    </div>
</div>
<!-- container END -->
@endsection

@push('bottom-scripts')
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace('postbody', {
    customConfig: 'config.js'
});
</script>

<script>
    $(document).ready(function () {
        $('#tags').selectize({
            delimiter: ',',
            persist: false,
            valueField: 'tag',
            labelField: 'tag',
            searchField: 'tag',
            options: tags,
            maxItems: 10,
            maxOptions: 100,
            plugins: ['remove_button'],
            create: function (input) {
                return {
                    tag: input
                }
            }
        });
    });
</script>

<script>
    var tags = [
            @foreach ($tags as $tag)
    {
    tag: "{{$tag}}"
    }
    ,
            @endforeach
    ];
</script>

@endpush
