<?php
/*
 *  File:post.list.blade.php part-of-project:lav_app encoding:UTF-8
 *  Last Modified at 7 Ιαν 2018 3:11:29 πμ.
 *  NOTE: COMMERCIAL LICENSE.. !
 *  Copyright 2018 KSNET.
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
        <li class="breadcrumb-item active">@lang_ucw('common.post_list')</li>
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

        <div id="ajaxResponse"></div>


        <div class="card">
            <div class="card-header"><i class="fa fa-copy"></i> @lang_ucw('common.post_list')</div>
            <div class="card-body">

                <nav class="nav mb-3 justify-content-center justify-content-md-end">
                    <!-- Top Button Group -->
                    <div class="btn-group" role="group">
                        @can('create', App\Post::class)
                        <button type="button" onclick="window.location.href ='{{route('adminpostcreate')}}'" class="btn btn-success">
                            @lang_ucw('common.create_new')
                            <i class="fa fa-plus-circle"></i>
                        </button>
                        @endcan
                        @can('deleteMany', App\Post::class)
                        <div class="btn-group d-none d-md-inline" role="group">
                            <button  type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                                @lang_ucw('common.with_checked_records')
                            </button>
                            <div class="dropdown-menu">
                                <div class="d-none">
                                    <form action="{{route('adminpostdeletemany')}}" method="post" name="deletechecked" id="deletechecked">
                                        {!! csrf_field() !!}
                                        {{ method_field('DELETE') }}
                                    </form>
                                </div>
                                <a href="#" class="dropdown-item"  onclick="if (confirm('{{__('common.confirm_delete_checked_records')}}')){ document.deletechecked.submit(); }">
                                    <i class="fa fa-trash"></i> @lang_ucw('common.delete')
                                </a>
                            </div>
                        </div>
                        @endcan
                    </div>
                    <!-- Top Button Group  End -->
                </nav>

                <form action="{{route('adminpostsearch')}}" method="get" name="search">
                    {!! csrf_field() !!}
                    <div class="form-row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" id="search" name="search" placeholder="search" value="@isset ($search) {{ $search }} @endisset">
                                @if($errors->has('search'))
                                <span class="help-block">{{ $errors->first('search') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 text-center text-md-left">
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-search"></i> @lang_ucw('common.search')
                            </button>
                            <a href="{{route('adminpostlist')}}"  class="btn btn-light ">
                                @lang_ucw('common.clear') <i class="fa fa-magic"></i>
                            </a>
                        </div>
                    </div>
                </form>

                @if (count($posts) === 0)
                <div class="alert alert-warning">
                    <i class="fa fa-exclamation-triangle"></i> &nbsp;
                    @lang_ucw('common.no_records_found')
                </div>
                @else
                <div class="row">
                    <div class="col-md-6 col-sm-12 p-2 text-center text-md-left">
                        <span class="badge badge-secondary">{{$posts->total()}}</span> <span class="">@lang_ucw('common.total_posts')</span>
                    </div>
                    <div class="col-md-6 col-sm-12 p-2 text-right">
                        <div class="d-none d-md-block">
                            <div class="d-inline">
                                {{ $posts->appends(\Request::except('page'))->render('resources.vendor.pagination.table-top-bootstrap-4') }}
                            </div>
                            <div class="small d-none d-lg-inline">
                                ({{__('pagination.page')}} {{ $posts->currentPage() }} {{__('pagination.page_from')}} {{ $posts->lastPage() }} {{__('pagination.pages')}})
                            </div>
                        </div>
                    </div>

                </div>
                @endif
            </div>

            @if (count($posts) > 0)
            <!-- Table -->
            <table class="table table-hover table-striped " style="background:#fff;">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="d-none d-md-table-cell">
                            <input  type="checkbox" class="" id="checkall">
                        </th>
                        <th scope="col" class="d-none d-sm-table-cell">
                            @sortablelink('id', 'Id')
                        </th>
                        <th scope="col">
                            @sortablelink('title', __('common.short_title'))
                        </th>
                        <th scope="col" class="text-center">
                            @sortablelink('active', __('common.short_active'))
                        </th>
                        <th scope="col" class="d-none d-md-table-cell text-center">
                            @sortablelink('order', __('common.short_order'))
                        </th>
                        <th scope="col" class="d-none d-md-table-cell">
                            @sortablelink('created_at', __('common.short_created_at'))
                        </th>
                        <th scope="col" class="d-none d-md-table-cell">
                            @sortablelink('updated_at', __('common.short_updated_at'))
                        </th>
                        <th scope="col" class="text-center">
                            @lang('common.short_actions')
                        </th>
                </thead>
                </tr>

                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td class="d-none d-md-table-cell">
                            <input class="deletechecked" type="checkbox" form="deletechecked" name="deletechecked[]" value="{{ $post->id }}">
                        </td>
                        <th scope="row" class="d-none d-sm-table-cell">
                            <span class="">{{ $post->id }}</span>
                        </th>
                        <td style="border-left:1px dashed #ddd;max-width:440px;">
                            <span class="{{ $post->active === 1 ? '' : 'gray-out' }}">
                                {{ str_limit($post->title , config('settings.admin_title_trim') , '...') }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="">
                                <i class="fa {{ $post->active === 1 ? 'fa-check' : 'fa-eye-slash gray-out' }}"></i>
                            </span>
                        </td>
                        <td class="d-none d-md-table-cell" style="max-width:64px;">
                            <form>
                                <div class="form-row">
                                    <div class="ml-auto mr-auto" style="max-width:64px;">
                                        <input type="text" class=" order d-inline"  name="order" maxlength="4" style="max-width:34px;" value="{{ $post->order }}" >
                                        <input type="hidden"  name="orderid"  value="{{ $post->id }}" >
                                        <i class="order-submit fa fa-save cursor-pointer d-inline"></i>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="small {{ $post->active === 1 ? '' : 'gray-out' }}">{{ $post->created_at }}</span>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="small {{ $post->active === 1 ? '' : 'gray-out' }}">{{ $post->updated_at }}</span>
                        </td>
                        <td class="text-center">
                            <a class="d-block d-sm-inline"
                               href="{{ route('adminpostedit', $post->id) }}"
                               title="@lang_ucw('common.edit')">
                                <i class="fa fa-pencil"></i>
                            </a> &nbsp;
                            <a class="d-block d-sm-inline"
                               href="{{url('post/'.$post->seotitle)}}"
                               title="@lang_ucw('common.display')">
                                <i class="fa fa-eye"></i>
                            </a> &nbsp;
                            <div class="d-none">
                                <form name="deletepost{{ $post->id }}" id="deletepost{{ $post->id }}" action="{{ route('adminpostdelete', $post->id) }}" method="post">
                                    {!! csrf_field() !!}
                                    {{ method_field('DELETE') }}
                                </form>
                            </div>
                            <a class="d-block d-sm-inline"
                               onclick="if (confirm('{{__('common.confirm_delete_record')}}: {{ $post->id }}?')){ document.deletepost{{ $post->id }}.submit(); }"
                               href="#"
                               title="@lang_ucw('common.delete')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            @if ($posts->total() > $posts->perPage())
            <div class="card-footer">
                {{ $posts->appends(\Request::except('page'))->render('resources.vendor.pagination.bootstrap-4') }}
            </div>
            @endif

        </div> <!-- Panel End -->

    </div>
</div>
@endsection

@push ('bottom-scripts')
<script>
    $(document).ready(function() {

    $('input#checkall').change(function(){
    if ($(this).is(':checked')) {
    $('input.deletechecked').prop('checked', true);
    $('input.deletechecked').parent().parent().addClass('table-warning');
    } else {
    $('input.deletechecked').prop('checked', false);
    $('input.deletechecked').parent().parent().removeClass('table-warning');
    }
    });
    $('input.deletechecked').change(function(){
    if ($(this).is(':checked')) {
    $(this).parent().parent().addClass('table-warning');
    } else {
    $(this).parent().parent().removeClass('table-warning');
    }
    });
    });</script>

<script type="text/javascript">
// disable form submit with Enter Key
    $('input.order').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
    e.preventDefault();
    return false;
    }
    });
// ajax reorder posts
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $(".order-submit").click(function(e){

    e.preventDefault();
    var order = $(this).closest('form').find("input[name=order]").val();
    var id = $(this).closest('form').find("input[name=orderid]").val();
    var selectedbutton = $(this);
    var selectedinput = $(this).closest('form').find("input[name=order]");
    $.ajax({

    type:'POST',
            url:'{{ route('adminpostreorder') }}',
            data:{order:order, id:id},
            success: function(response, success, error) {

            if (response.success) {
            $(selectedinput).addClass('text-success');
            $(selectedbutton).addClass('text-success');
            setTimeout(function () {
            $(selectedinput).removeClass("text-success");
            $(selectedbutton).removeClass("text-success");
            }, 2200);
            //alert(response.success);
            }
            else if (response.error) {
            $(selectedinput).addClass('text-danger');
            $(selectedbutton).addClass('text-danger');
            setTimeout(function () {
            $(selectedinput).removeClass("text-danger");
            $(selectedbutton).removeClass("text-danger");
            }, 4200);
            alert(response.error);
            }

            }

    });
    });

</script>
@endpush

