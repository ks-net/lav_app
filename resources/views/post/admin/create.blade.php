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
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-list-alt"></i> <a href="{{route('admin')}}">@lang_ucw('common.admin_dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{route('adminpostlist')}}">@lang_ucw('common.post_list')</a></li>
        <li class="breadcrumb-item active">@lang_ucw('common.create_new_post')</li>
    </ol>
</nav>
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
            <div class="card-header"><i class="fa fa-plus-square"></i> @lang_ucw('common.create_new_post')</div>
            <div class="card-body">

                <nav class="nav mb-3 justify-content-center justify-content-md-end">
                    <a href="{{route('adminpostlist')}}" class="btn btn-danger">@lang_ucf('common.back_to') @lang_ucw('common.post_list') <i class="fa fa-sign-out"></i></a>
                </nav>

                <!-- START ADD FORM  -->
                <form action="{{route('adminpostcreate')}}" method="post" enctype="multipart/form-data">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0  pl-2">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('title') ? ' text-danger' : '' }}" for="title">@lang_ucw('common.title')</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" placeholder="@lang_ucw('common.title')" value="{{ old('title') }}">
                        @if($errors->has('title'))
                        <small class="form-text{{ $errors->has('title') ? ' text-danger' : '' }}">{{ $errors->first('title') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('seotitle') ? ' text-danger' : '' }}" for="seotitle">@lang_ucw('common.seotitle')</label>
                        <input type="text" class="form-control{{ $errors->has('seotitle') ? ' is-invalid' : '' }}" id="seotitle" name="seotitle" placeholder="@lang_ucw('common.seotitle')" value="{{ old('seotitle') }}">
                        @if($errors->has('seotitle'))
                        <small class="form-text{{ $errors->has('seotitle') ? ' text-danger' : '' }}">{{ $errors->first('seotitle') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('main_img') ? ' text-danger' : '' }}" for="main_img">@lang_ucw('common.main_image')</label>
                        <input type="file" class="form-control{{ $errors->has('main_img') ? ' is-invalid' : '' }}" name="main_img" id="main_img" value="{{ old('main_img') }}">
                        @if($errors->has('main_img'))
                        <small class="form-text{{ $errors->has('main_img') ? ' text-danger' : '' }}">{{ $errors->first('main_img') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('sortdesc') ? ' text-danger' : '' }}" for="sortdesc">@lang_ucw('common.sortdesc')</label>
                        <textarea class="form-control{{ $errors->has('sortdesc') ? ' is-invalid' : '' }}" id="sortdesc" name="sortdesc" placeholder="@lang_ucw('common.sortdesc')">{{ old('sortdesc') }}</textarea>
                        @if($errors->has('sortdesc'))
                        <small class="form-text{{ $errors->has('sortdesc') ? ' text-danger' : '' }}">{{ $errors->first('sortdesc') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('postbody') ? ' text-danger' : '' }}" for="postbody">@lang_ucw('common.text_area')</label>
                        <textarea class="form-control{{ $errors->has('postbody') ? ' is-invalid' : '' }}" id="postbody" name="postbody" placeholder="@lang_ucw('common.text_area')">{{ old('postbody') }}</textarea>
                        @if($errors->has('postbody'))
                        <small class="form-text{{ $errors->has('postbody') ? ' text-danger' : '' }}">{{ $errors->first('postbody') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('tags') ? ' text-danger' : '' }}" for="tags">@lang_ucw('common.tags')</label>
                        <input type="text" class="form-control{{ $errors->has('tags') ? ' is-invalid' : '' }}" name="tags" id="tags" value="{{ old('tags') }}">
                        @if($errors->has('tags'))
                        <small class="form-text{{ $errors->has('tags') ? ' text-danger' : '' }}">{{ $errors->first('tags') }}</small>
                        @endif
                        <small class="form-text text-muted">@lang('common.tags_help')</small>
                    </div>
                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('metatitle') ? ' text-danger' : '' }}" for="metatitle">@lang_ucw('common.metatitle')</label>
                        <input type="text" class="form-control{{ $errors->has('metatitle') ? ' is-invalid' : '' }}" id="metatitle" name="metatitle" placeholder="@lang_ucw('common.metatitle')" value="{{ old('metatitle') }}">
                        @if($errors->has('metatitle'))
                        <small class="form-text{{ $errors->has('metatitle') ? ' text-danger' : '' }}">{{ $errors->first('metatitle') }}</small>
                        @endif
                        <small class="form-text text-muted">@lang('common.metatitle_help')</small>
                    </div>
                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('metadesc') ? ' text-danger' : '' }}" for="metadesc">@lang_ucw('common.metadesc')</label>
                        <textarea class="form-control{{ $errors->has('metadesc') ? ' is-invalid' : '' }}" id="metadesc" name="metadesc" placeholder="@lang_ucw('common.metadesc')">{{ old('metadesc') }}</textarea>
                        @if($errors->has('metadesc'))
                        <small class="form-text{{ $errors->has('metadesc') ? ' text-danger' : '' }}">{{ $errors->first('metadesc') }}</small>
                        @endif
                        <small class="form-text text-muted">@lang('common.metadesc_help')</small>
                    </div>
                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('metakeywords') ? ' text-danger' : '' }}" for="metakeywords">@lang_ucw('common.metakeywords')</label>
                        <input type="text" class="form-control{{ $errors->has('metakeywords') ? ' is-invalid' : '' }}" id="metakeywords" name="metakeywords" placeholder="@lang_ucw('common.metakeywords')" value="{{ old('metakeywords') }}">
                        @if($errors->has('metakeywords'))
                        <small class="form-text{{ $errors->has('metakeywords') ? ' text-danger' : '' }}">{{ $errors->first('metakeywords') }}</small>
                        @endif
                        <small class="form-text text-muted">@lang('common.metakeywords_help')</small>
                    </div>

                <nav class="nav mb-3 justify-content-center justify-content-md-start">
                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> @lang_ucw('common.save')</button>
                </nav>

                </form>
                <!-- END ADD FORM  -->

            </div>
        </div> <!-- card END -->

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
