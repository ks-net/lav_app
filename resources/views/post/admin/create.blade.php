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
    <li><i class="fa fa-list-alt"></i> <a href="{{route('admin')}}">{{__('common.admin_dashboard')}}</a></li>
    <li><a href="{{route('adminpostlist')}}">{{__('common.list_all_posts')}}</a></li>
    <li class="active">{{__('common.create_new_post')}}</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-md-offset-0">

        @if (Session::has('flash_message'))
        <div class="alert alert-info"><i class="fas fa-info-circle"></i> {{ Session::get('flash_message') }}</div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-plus-square"></i> {{__('common.create_new_post')}}</div>

            <div class="panel-body">
                <div class="well-sm text-right">
                    <a href="{{route('adminpostlist')}}" class="btn btn-danger">{{__('common.Back_to')}} {{__('common.list_all_posts')}} <i class="fa fa-sign-out"></i></a>
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
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
                        @if($errors->has('title'))
                        <span class="help-block">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('seotitle') ? ' has-error' : '' }}">
                        <label for="seotitle">Seotitle</label>
                        <input type="text" class="form-control" id="seotitle" name="seotitle" placeholder="seotitle" value="{{ old('seotitle') }}">
                        @if($errors->has('seotitle'))
                        <span class="help-block">{{ $errors->first('seotitle') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('main_img') ? ' has-error' : '' }}">
                        <label for="main_img">Post Main Image</label>
                        <input type="file" name="main_img" id="main_img" value="{{ old('main_img') }}">
                        @if($errors->has('main_img'))
                        <span class="help-block">{{ $errors->first('main_img') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('sortdesc') ? ' has-error' : '' }}">
                        <label for="sortdesc">Sortdesc</label>
                        <textarea class="form-control" id="sortdesc" name="sortdesc" placeholder="sortdesc">{{ old('sortdesc') }}</textarea>
                        @if($errors->has('sortdesc'))
                        <span class="help-block">{{ $errors->first('sortdesc') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('postbody') ? ' has-error' : '' }}">
                        <label for="postbody">Postbody</label>
                        <textarea class="form-control" id="postbody" name="postbody" placeholder="postbody">{{ old('postbody') }}</textarea>
                        @if($errors->has('postbody'))
                        <span class="help-block">{{ $errors->first('postbody') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        {{-- populate with saved and new unsaved tags if present... NO GAPS OR SPACES ... COMMAS ARE IMPORTANT --}}
                        <input type="text" name="tags" id="tags" value="{{ old('tags') }}">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
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
            plugins: ['remove_button'],
            create: function (input) {
                return {
                    tag: input
                }
            }
        });
    });</script>
<script>
    var tags = [
            @foreach ($tags as $tag)
    {
    tag: "{{$tag}}"
    }
    ,
            @endforeach
    ];</script>

@endpush
