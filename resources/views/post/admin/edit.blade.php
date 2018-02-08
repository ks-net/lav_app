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

@section('breadcrumbs')
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-list-alt"></i> <a href="{{route('admin')}}">@lang_ucw('common.admin_dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{route('adminpostlist')}}">@lang_ucw('common.post_list')</a></li>
        <li class="breadcrumb-item active">@lang_ucw('common.edit_post')</li>
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
            <div class="card-header"><i class="fa fa-edit"></i> @lang_ucw('common.edit_post')</div>
            <div class="card-body">

                <nav class="nav mb-3 justify-content-center justify-content-md-end">
                    <a href="{{route('adminpostlist')}}" class="btn btn-danger">@lang_ucf('common.back_to') @lang_ucw('common.post_list') <i class="fa fa-sign-out"></i></a>
                </nav>

                <!-- Button trigger modal -->
                <button type="button" data-remote="{{route('modal')}}" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Launch demo modal
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ....
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End  modal -->


                <!-- START ADD FORM  -->
                <form action="{{ route('adminpostupdate', $post->id) }}" method="post" enctype="multipart/form-data">

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
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <select class="form-control{{ $errors->has('active') ? ' is-invalid' : '' }}" id="active" name="active">
                            <option value="0" @if (old('active' , $post->active) == '0') selected="selected" @endif>@lang_ucw('common.unpublished')</option>
                            <option value="1" @if (old('active' , $post->active) == '1') selected="selected" @endif>@lang_ucw('common.published')</option>
                        </select>
                        @if($errors->has('active'))
                        <span class="form-text{{ $errors->has('active') ? ' text-danger' : '' }}">{{ $errors->first('active') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
{{ $post->user_id }}
                    </div>

                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('title') ? ' text-danger' : '' }}" for="title">@lang_ucw('common.title')</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" placeholder="@lang_ucw('common.title')" value="{{ old('title' , $post->title) }}">
                        @if($errors->has('title'))
                        <span class="form-text{{ $errors->has('title') ? ' text-danger' : '' }}">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('seotitle') ? ' text-danger' : '' }}" for="seotitle">@lang_ucw('common.seotitle')</label>
                        <input type="text" class="form-control{{ $errors->has('seotitle') ? ' is-invalid' : '' }}" id="seotitle" name="seotitle" placeholder="@lang_ucw('common.seotitle')" value="{{ old('seotitle' , $post->seotitle)  }}">
                        @if($errors->has('seotitle'))
                        <span class="form-text{{ $errors->has('seotitle') ? ' text-danger' : '' }}">{{ $errors->first('seotitle') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('main_img') ? ' text-danger' : '' }}" for="main_img">@lang_ucw('common.main_image')</label>
                        <input type="file" class="form-control{{ $errors->has('main_img') ? ' is-invalid' : '' }}" name="main_img" id="main_img" value="{{ old('main_img' , $post->main_img)  }}">
                        @if($errors->has('main_img'))
                        <span class="form-text{{ $errors->has('main_img') ? ' text-danger' : '' }}">{{ $errors->first('main_img') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('sortdesc') ? ' text-danger' : '' }}" for="sortdesc">@lang_ucw('common.sortdesc')</label>
                        <textarea class="form-control{{ $errors->has('sortdesc') ? ' is-invalid' : '' }}" id="sortdesc" name="sortdesc" placeholder="@lang_ucw('common.sortdesc')">{{ old('sortdesc' , $post->sortdesc)  }}</textarea>
                        @if($errors->has('sortdesc'))
                        <span class="form-text{{ $errors->has('sortdesc') ? ' text-danger' : '' }}">{{ $errors->first('sortdesc') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('postbody') ? ' text-danger' : '' }}" for="postbody">@lang_ucw('common.text_area')</label>
                        <textarea class="form-control{{ $errors->has('postbody') ? ' is-invalid' : '' }}" id="postbody" name="postbody" placeholder="@lang_ucw('common.text_area')">{{ old('postbody' , $post->postbody)  }}</textarea>
                        @if($errors->has('postbody'))
                        <span class="form-text{{ $errors->has('postbody') ? ' text-danger' : '' }}">{{ $errors->first('postbody') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('tags') ? ' text-danger' : '' }}" for="tags">@lang_ucw('common.tags')</label>

                        {{--  ---- Somehow the Hard-way ----  --}}

                        @php

                        $class = 'form-control' ;

                        if($errors->has('tags')){
                        $class = 'form-control is-invalid' ;
                        }

                        if (old('tags')) {

                        echo '<input type="text" class="'.$class.'" name="tags" id="tags" value="'. old('tags') .'">';

                        } elseif  (count($tags) > 0) {

                        $savedtags = array();

                        foreach($tags as $tag) {
                        $savedtags[] = $tag ;
                        }

                        $savedtags = implode(',', $savedtags) ;

                        echo '<input type="text" class="'.$class.'" name="tags" id="tags" value="'. $savedtags .'">';
                        } else {
                        echo '<input type="text" class="'.$class.'" name="tags" id="tags" value="">';
                        }

                        @endphp

                        {{-- ---- ---- ---- -----   --}}

                        @if($errors->has('tags'))
                        <span class="form-text{{ $errors->has('tags') ? ' text-danger' : '' }}">{{ $errors->first('tags') }}</span>
                        @endif
                        <span class="form-text text-muted">@lang('common.tags_help')</span>
                    </div>

                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('metatitle') ? ' text-danger' : '' }}" for="metatitle">@lang_ucw('common.metatitle')</label>
                        <input type="text" class="form-control{{ $errors->has('metatitle') ? ' is-invalid' : '' }}" id="metatitle" name="metatitle" placeholder="@lang_ucw('common.metatitle')" value="{{ old('metatitle' , $post->metatitle)  }}">
                        @if($errors->has('metatitle'))
                        <span class="form-text{{ $errors->has('metatitle') ? ' text-danger' : '' }}">{{ $errors->first('metatitle') }}</span>
                        @endif
                        <span class="form-text text-muted">@lang('common.metatitle_help')</span>
                    </div>
                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('metadesc') ? ' text-danger' : '' }}" for="metadesc">@lang_ucw('common.metadesc')</label>
                        <textarea class="form-control{{ $errors->has('metadesc') ? ' is-invalid' : '' }}" id="metadesc" name="metadesc" placeholder="@lang_ucw('common.metadesc')">{{ old('metadesc' , $post->metadesc)  }}</textarea>
                        @if($errors->has('metadesc'))
                        <span class="form-text{{ $errors->has('metadesc') ? ' text-danger' : '' }}">{{ $errors->first('metadesc') }}</span>
                        @endif
                        <span class="form-text text-muted">@lang('common.metadesc_help')</span>
                    </div>
                    <div class="form-group">
                        <label class="text-primary{{ $errors->has('metakeywords') ? ' text-danger' : '' }}" for="metakeywords">@lang_ucw('common.metakeywords')</label>
                        <input type="text" class="form-control{{ $errors->has('metakeywords') ? ' is-invalid' : '' }}" id="metakeywords" name="metakeywords" placeholder="@lang_ucw('common.metakeywords')" value="{{ old('metakeywords' , $post->metakeywords)  }}">
                        @if($errors->has('metakeywords'))
                        <span class="form-text{{ $errors->has('metakeywords') ? ' text-danger' : '' }}">{{ $errors->first('metakeywords') }}</span>
                        @endif
                        <span class="form-text text-muted">@lang('common.metakeywords_help')</span>
                    </div>

                    <nav class="nav mb-3 justify-content-center justify-content-md-start">
                        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> @lang_ucw('common.save')</button>
                    </nav>

                </form>
                <!-- END ADD FORM  -->

            </div>
        </div> <!-- Card END -->

    </div>
</div>
<!-- Row END -->
@endsection

@push('bottom-scripts')
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>


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
            maxItems: 10,
            maxOptions: 100,
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
            @foreach ($modeltags as $modeltag)
    {
    tag: "{{$modeltag}}"
    }
    ,
            @endforeach
    ];
</script>

<script>
    $('body').on('click', '[data-toggle="modal"]', function () {
        $($(this).data("target") + ' .modal-body').load($(this).data("remote"));



    });


</script>


@endpush
