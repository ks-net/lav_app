<?php
/*
 *  File:blog.blade.php part-of-project:lav_app encoding:UTF-8
 *  Last Modified at 28 Δεκ 2017 11:23:02 μμ.
 *  NOTE: COMMERCIAL LICENSE.. !
 *  Copyright 2017 KSNET.
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
                <div class="panel-heading" style="font-weight: 300;"><i class="fas fa-caret-right"></i> Αυτή θα είναι η λίστα με τα άρθρα -> post list layout
                    <ul>
                        <li>PAGINATION SETTING= <b>{{ config('settings.artlistpagin') }}</b></li>
                        <li>CACHETIME SETTING= <b>{{ config('settings.cachetime') }}</b></li>
                    </ul>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <h3><i class="fas fa-th-list"></i> ΛΙΣΤΑ ΑΡΘΡΩΝ - Αγγλικός Τίτλος:  LIST-ALL-POSTS BLADE VIEW</h3>
                    <a href="{{route('adminpostcreate')}}" class="btn btn-success"> Create New Post <i class="fas fa-plus-circle"></i></a>
                    <a href="{{url('post/')}}" class="btn btn-default"> Posts Index Page <i class="fas fa-share"></i></a>
                    <a href="{{route('adminpostlist')}}" class="btn btn-danger"> Posts List Page <i class="fas fa-share"></i></a>
                    <hr/>

                    @isset ($posts)
                    @foreach ($posts as $post)
                    <ul>
                        <li><b>ID</b>= {{ $post->id }}</li>
                        <li><b>{{__('general.Title')}} </b>= <span style="color:#3097D1;text-transform:uppercase;font-weight:700;">
                                <a href="{{url('post/'.$post->seotitle)}}">{{ str_limit($post->title , config('settings.frontend_title_trim') , '...') }}</a>
                            </span>
                        </li>
                    </ul>
                    @if ($post->main_img)
                    <img class="img-responsive center-block" src="{{ asset('storage/media/postimages/'.$post->id.'/post_'.$post->id.'_medium_img.jpg') }}" />
                    @endif
                    <ul>
                        <li><b>{{__('general.Sortdesc')}}</b>= {{ str_limit($post->sortdesc , config('settings.frontend_desc_trim') , '...') }}</li>

                        <li><b>METATITLE</b>= {{ $post->metatitle }}</li>
                        <li><b>METAKEYWORDS</b>= {{ $post->metakeywords }}</li>
                        <li><b>METADESC</b>= {{ $post->metadesc }}</li>
                        <li><b>TAGS</b>=  </li>
                        <li><b>SEOTITLE</b>= <span style="color:#2AB27B;font-style:italic;"><a href="{{url('post/'.$post->seotitle)}}">{{ $post->seotitle }}</a></span></li>
                        <li><b>ACTIVE</b>= {{ $post->active }}</li>
                        <li><b>CREATED_AT</b>= {{ $post->created_at }}</li>
                        <li><b>UPDATED_AT</b>= {{ $post->updated_at }}</li>
                    </ul>
                    <hr/>
                    @endforeach
                    {{ $posts->links() }}
                    @endisset

                    @empty($posts)
                    NO POSTS YET
                    @endempty

                    @if (count($posts) === 0)
                    I don't have any records!
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection