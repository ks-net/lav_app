<?php

/*
 *  File:edit.blade.php  encoding:UTF-8
 *  Created at 01-13-2018 (mm/dd/yyyy) 02:19:10
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
            <div class="alert alert-info"><i class="fas fa-info-circle"></i> {{ Session::get('flash_message') }}</div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading"><i class="fas fa-caret-right"></i> this will be add-new-post layout</div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-info">
                        {{ session('status') }}
                    </div>
                    @endif
                    <h3><i class="fas fa-edit"></i> EDIT FORM</h3>
                    <a href="{{route('adminpostlist')}}" class="btn btn-danger"> Posts Index Page <i class="fas fa-share"></i></a>
                    <a href="{{url('post/')}}" class="btn btn-default"> Posts Index Page <i class="fas fa-share"></i></a>


                    <!-- START ADD FORM  -->
                    <h1>Add New Post</h1>
                    <form action="{{ route('adminpostupdate', $post->id) }}" method="post" enctype="multipart/form-data">

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
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $post->title }}">
                            @if($errors->has('title'))
                            <span class="help-block">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('seotitle') ? ' has-error' : '' }}">
                            <label for="seotitle">Seotitle</label>
                            
                            @if($errors->has('seotitle'))
                            <span class="help-block">{{ $errors->first('seotitle') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('main_img') ? ' has-error' : '' }}">
                            <label for="main_img">Post Main Image</label>
                            <input type="file" name="main_img" id="main_img" value="{{ $post->main_img }}">
                            @if($errors->has('main_img'))
                            <span class="help-block">{{ $errors->first('main_img') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('sortdesc') ? ' has-error' : '' }}">
                            <label for="sortdesc">Sortdesc</label>
                            <textarea class="form-control" id="sortdesc" name="sortdesc" placeholder="sortdesc">{{ $post->sortdesc }}</textarea>
                            @if($errors->has('sortdesc'))
                            <span class="help-block">{{ $errors->first('sortdesc') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('postbody') ? ' has-error' : '' }}">
                            <label for="postbody">Postbody</label>
                            <textarea class="form-control" id="postbody" name="postbody" placeholder="postbody">{{ $post->postbody }}</textarea>
                            @if($errors->has('postbody'))
                            <span class="help-block">{{ $errors->first('postbody') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <input type="text" name="tags" id="tags" value="{{ $post->tags }}">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    <!-- END ADD FORM  -->

                </div>
            </div> <!-- panel END -->

        </div>
    </div>
</div> <!-- container END -->

@endsection

@push('bottom-scripts')
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{asset('js/ajax-postcreate.js')}}"></script>
<script>
CKEDITOR.replace('postbody', {
customConfig: 'config.js'
        });</script>

<script>
    $(document).ready(function () {
    $('#tags').selectize({
    delimiter: ',',
            persist: false,
            valueField: 'tag',
            labelField: 'tag',
            searchField: 'tag',
            options: tags,
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
