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
                    <a href="{{route('adminpostlist')}}" class="btn btn-danger"> Posts Index Page <i class="fas fa-share"></i></a>
                 <a href="{{url('post/')}}" class="btn btn-default"> Posts Index Page <i class="fas fa-share"></i></a>
                    <!-- Button trigger modal -->
                    <a   class="btn btn-primary" href="../media/modal" data-toggle="modal" data-target="#myModal">
                        Launch demo modal
                    </a>

                    <br/>  <br/>
                    <a id="moreBtn" href="#">ajax</a>

                    <div id="div1"><i id="loader" class="fas fa-spinner" style="display:none;"></i></div>

                    <!-- START ADD FORM  -->
                    <h1>Add New Post</h1>
                    <form action="/post/create" method="post" enctype="multipart/form-data">

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
                            <input type="text" name="tags" id="tags" value="{{ old('tags') }}">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    <!-- END ADD FORM  -->

                </div>
            </div> <!-- panel END -->

        </div>
    </div>
</div> <!-- container END -->



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ....
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('bottom-scripts')
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{asset('js/ajax-postcreate.js')}}"></script>
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

<script>

              $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
             });

$('#moreBtn').click(function () {
$.ajax({
  url: "../media",
  cache: false
})

  .done(function( html ) {
    $( "#div1" ).append( html );
  });
});
</script>
@endpush
