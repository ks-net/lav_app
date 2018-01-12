<?php
/*
 *  File:postsingle.blade.php part-of-project:lav_app encoding:UTF-8
 *  Last Modified at 6 Ιαν 2018 6:23:02 πμ.
 *  NOTE: COMMERCIAL LICENSE.. !
 *  Copyright 2018 KSNET.
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
                        <li>CACHETIME SETTING= <b>{{ config('settings.cachetime') }}</b></li>
                    </ul>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <h3><i class="fas fa-clipboard"></i>  {{ $post->title }} </h3>
                 <a href="{{route('adminpostcreate')}}" class="btn btn-success"> Create New Post <i class="fas fa-plus-circle"></i></a>
                 <a href="{{url('post/')}}" class="btn btn-default"> Posts Index Page <i class="fas fa-share"></i></a>
                 <a href="{{route('adminpostlist')}}" class="btn btn-danger"> Posts List Page <i class="fas fa-share"></i></a>
                    <hr/>


                    <ul>
                        <li><b>ID</b>= {{ $post->id }}</li>
                        <li><b>{{__('general.Title')}} </b>= <span style="color:#3097D1;text-transform:uppercase;font-weight:700;">{{ $post->title }}</span></li>
                    </ul>
                    @if ($post->main_img)
                    <img  class="img-responsive center-block" src="{{ asset($post->main_img) }}" />
                    @endif
                    <ul>
                        <li><b>{{__('general.Sortdesc')}}</b>= {{ $post->sortdesc }}</li>
                        <li><b>POSTBODY</b>= {!! $post->postbody !!}</li>
                        <li><b>METATITLE</b>= {{ $post->metatitle }}</li>
                        <li><b>METAKEYWORDS</b>= {{ $post->metakeywords }}</li>
                        <li><b>METADESC</b>= {{ $post->metadesc }}</li>
                        <li><b>SEOTITLE</b>= <span style="color:#2AB27B;font-style:italic;">{{ $post->seotitle }}</span></li>
                        <li><b>ACTIVE</b>= {{ $post->active }}</li>
                        <li><b>CREATED_AT</b>= {!! $post->created_at->formatLocalized('%A %d %B %Y') !!}</li>
                        <li><b>UPDATED_AT</b>= {{ $post->updated_at->diffForHumans() }}</li>
                    </ul>

                    <hr/>
                    @if (count($tags) > 0)
                    {{__('general.Tags')}}: <i class="fas fa-tags"></i>
                    @foreach ($tags as $tag)
                    <a href="#"  class="label label-info">{{ $tag->normalized }}</a>
                    @endforeach
                    <hr/>
                    @endif

                    @if ($previous)
                    <span  class="pull-left text-left col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <a class="btn btn-default" href="{{url('post/'.$previous->seotitle)}}"><i class="fas fa-chevron-circle-left"></i> {{__('general.Previous')}}</a>
                        <br/>
                        <span class="text-left small previous-link-title">
                            {{ str_limit($previous->title, '120', '...') }}
                        </span>
                    </span>
                    @endif
                    @if ($next)
                    <span class="pull-right text-right col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <a class="btn btn-default" href="{{url('post/'.$next->seotitle)}}">{{__('general.Next')}} <i class="fas fa-chevron-circle-right"></i></a>
                        <br/>
                        <span class="text-right small next-link-title">
                            {{ str_limit($next->title, '120', '...') }}
                        </span>
                    </span>
                    @endif
                    <div class="clear"></div>
                    <br/><br/>

                    <!-- START DISQUS COMMENTS -->
                    <div id="disqus_thread" class="well-lg"></div>

                </div> <!-- Panel Body end -->
            </div>


            @push('bottom-scripts')
            <script>
                /**
                 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

                var disqus_config = function () {
                    this.page.url = "http://lav.loc/post/{{ $post->seotitle }}"; // Replace PAGE_URL with your page's canonical URL variable
                    this.page.identifier = "{{ $post->seotitle }}_{{ $post->id }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                };
                (function () { // DON'T EDIT BELOW THIS LINE
                    var d = document, s = d.createElement('script');
                    s.src = 'https://lavapp.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
            <script id="dsq-count-scr" src="//lavapp.disqus.com/count.js" async></script>
            @endpush

        </div>
    </div>
</div>
@endsection

