<?php

/*
 *  File:media-add.blade.php  encoding:UTF-8
 *  Created at 01-10-2018 (mm/dd/yyyy) 23:52:51
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
                    <h3><i class="fas fa-edit"></i> CREATE-ADD NEW POST BLADE VIEW</h3>
                    <a href="{{route('adminmedialist')}}" class="btn btn-default"> Media Index Page <i class="fas fa-image"></i></a>

                    <!-- START ADD FORM  -->
                    <h1>Add New Post</h1>
                    <form action="{{route('adminmediaadd')}}" method="post" enctype="multipart/form-data">

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
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">Title</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                            @if($errors->has('title'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                            <label for="desc">Seotitle</label>
                            <input type="text" class="form-control" id="desc" name="desc" placeholder="Description" value="{{ old('desc') }}">
                            @if($errors->has('seotitle'))
                            <span class="help-block">{{ $errors->first('desc') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image">Post Main Image</label>
                            <input type="file" name="image" id="image" value="{{ old('image') }}">
                            @if($errors->has('main_img'))
                            <span class="help-block">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <input type="text" name="tags" id="tags" value="{{ old('tags') }}">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    <!-- END ADD FORM  -->

                </div>
            </div>

        </div>
    </div>
</div>
</div>
</div>
@endsection


@push('bottom-scripts')
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
