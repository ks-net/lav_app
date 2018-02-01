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
        <li class="breadcrumb-item"><i class="fa fa-list-alt"></i> <a href="{{route('admin')}}">@lang_ucw('common.admin_dashboard')</a>
        </li>
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

        <div class="card">
            <div class="card-header"><i class="fa fa-copy"></i> @lang_ucw('common.post_list')</div>
            <div class="card-body">

                <nav class="nav mb-3 justify-content-center justify-content-md-end">
                    <!-- Top Button Group -->
                    <div class="btn-group" role="group">
                        @if ($cancreate)
                        <button type="button" onclick="window.location.href ='{{route('adminpostcreate')}}'" class="btn btn-success">
                            @lang_ucw('common.create_new')
                            <i class="fa fa-plus-circle"></i>
                        </button>
                        @endif
                        @if ($candeletemany)
                        <div class="btn-group d-none d-md-inline" role="group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                                @lang_ucw('common.with_checked_records')
                            </button>
                            <div class="dropdown-menu">
                                <div class="d-none">
                                    <form action="{{route('adminpostdeletemany')}}" method="post" name="deletechecked" id="deletechecked">
                                        {!! csrf_field() !!}
                                        {{ method_field('DELETE') }}
                                    </form>
                                </div>
                                <a href="javascript:void(0);" class="dropdown-item" onclick="if (confirm('{{__('common.confirm_delete_checked_records')}}')){ document.deletechecked.submit(); }">
                                    <i class="fa fa-trash"></i>
                                    @lang_ucw('common.delete')
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- Top Button Group  End -->
                </nav>

                @can('adminSearchPosts', App\Post::class)
                <form action="{{route('adminpostsearch')}}" method="get" name="search">
                    {!! csrf_field() !!}
                    <div class="form-row">
                        <div class="col-lg-5 col-sm-12 mt-2">
                            <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
                                <input type="text" class="form-control p-2" id="search" name="search" placeholder="search" value="@isset ($search){{$search}}@endisset">
                                @if($errors->has('search'))
                                <span class="help-block">{{ $errors->first('search') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-7 col-sm-12 text-center text-lg-left ">
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-search"></i> @lang_ucw('common.search')
                            </button>
                            <a href="{{route('adminpostlist')}}" class="btn btn-light ">
                                @lang_ucw('common.clear') <i class="fa fa-magic"></i>
                            </a>
                            <div class="d-inline-block col-lg-6 col-md-4 col-sm-9 mt-2">
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                                    </div>
                                    <select class="form-control" id="user" name="user">
                                        <option value="">@lang_ucw('common.filter_by_user')</option>
                                        @foreach ($users as $user)
                                        @isset ($selecteduser)
                                        <option value="{{$user->id}}" @if ($selecteduser == $user->id) selected @endif>{{$user->name}}</option>
                                        @else
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endisset
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @endcan

                @if (count($posts) === 0)
                <div class="alert alert-warning">
                    <i class="fa fa-exclamation-triangle"></i> &nbsp;
                    @lang_ucw('common.no_records_found')
                </div>
                @else
                <div class="row">
                    <div class="col-md-4 col-sm-12 mt-2 pt-1  text-center text-md-left">
                        <span class="badge badge-secondary">{{$posts->total()}}</span> <span class="">@lang_ucw('common.total_posts')</span>
                    </div>
                    <div class="col-md-8 col-sm-12 p-2 text-right">
                        <div class="d-none d-md-block">
                            <div class="d-inline">
                                {{ $posts->appends(\Request::except('page'))->render('resources.vendor.pagination.table-top-bootstrap-4') }}
                            </div>
                            <div class="small d-none d-lg-inline">
                                ({{__('pagination.page')}} {{ $posts->currentPage() }} {{__('pagination.page_from')}} {{$posts->lastPage() }} {{__('pagination.pages')}})
                            </div>
                        </div>
                    </div>

                </div>
                @endif
            </div> <!-- Card Body End -->

            @if (count($posts) > 0)
            <!-- Table -->
            <table class="table table-hover table-striped " style="background:#fff;">
                <thead class="thead-light">
                    <tr>
                        @if ($candeletemany)
                        <th scope="col" class="d-none d-md-table-cell">
                            <input type="checkbox" class="" id="checkall">
                        </th>
                        @endif
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
                    <tr class="{{ $post->active === 1 ? '' : 'gray-out' }}">
                        @if ($candeletemany)
                        <td class="d-none d-md-table-cell">
                            <input class="deletechecked" type="checkbox" form="deletechecked" name="deletechecked[]" value="{{ $post->id }}">
                        </td>
                        @endif
                        <th scope="row" class="d-none d-sm-table-cell">
                            <span class="">{{ $post->id }}</span>
                        </th>
                        <td style="border-left:1px dashed #ddd;max-width:440px;">
                            <span class="">
                                {{ str_limit($post->title , config('settings.admin_title_trim') , '...') }}
                            </span>
                        </td>
                        <td class="text-center">
                            <i class="activatepost cursor-pointer fa {{ $post->active === 1 ? 'fa-check active' : 'fa-eye-slash inactive' }}"></i>
                            <input type="hidden" name="activateid" value="{{ $post->id }}">
                        </td>
                        <td class="d-none d-md-table-cell" style="max-width:64px;">
                            <form>
                                <div class="form-row">
                                    <div class="ml-auto mr-auto" style="max-width:64px;">
                                        <input type="text" class="form-control p-1 order d-inline" name="order" maxlength="4" style="max-width:34px;" value="{{ $post->order }}">
                                        <input type="hidden" name="orderid" value="{{ $post->id }}">
                                        <i class="order-submit fa fa-save cursor-pointer d-inline"></i>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="small">{{ $post->created_at }}</span>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="small">{{ $post->updated_at }}</span>
                        </td>
                        <td class="text-center">
                            @if ($canedit)
                            <a class="d-block d-sm-inline" href="{{ route('adminpostedit', $post->id) }}" title="@lang_ucw('common.edit')">
                                <i class="fa fa-pencil"></i>
                            </a> &nbsp;
                            @endif
                            <a class="d-block d-sm-inline" href="{{url('post/'.$post->seotitle)}}" title="@lang_ucw('common.display')">
                                <i class="fa fa-eye"></i>
                            </a> &nbsp;
                            @if ($candelete)
                            <div class="d-none">
                                <form name="deletepost{{ $post->id }}" id="deletepost{{ $post->id }}"action="{{ route('adminpostdelete', $post->id) }}" method="post">
                                    {!! csrf_field() !!}
                                    {{ method_field('DELETE') }}
                                </form>
                            </div>
                            <a class="d-block d-sm-inline"
                               onclick="if (confirm('{{__('common.confirm_delete_record')}}: {{ $post->id }}?')){ document.deletepost{{ $post->id }}.submit(); }"
                               href="javascript:void(0);"
                               title="@lang_ucw('common.delete')">
                                <i class="fa fa-trash"></i>
                            </a>
                            @endif
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

        </div>
        <!-- Card End -->

    </div>
</div>
@endsection

@push ('bottom-scripts')

<script>
    $(document).ready(function () {

    $('input#checkall').change(function () {
    if ($(this).is(':checked')) {
    $('input.deletechecked').prop('checked', true);
    $('input.deletechecked').closest('tr').addClass('table-warning');
    } else {
    $('input.deletechecked').prop('checked', false);
    $('input.deletechecked').closest('tr').removeClass('table-warning');
    }
    });
    $('input.deletechecked').change(function () {
    if ($(this).is(':checked')) {
    $(this).closest('tr').addClass('table-warning');
    } else {
    $(this).closest('tr').removeClass('table-warning');
    }
    });
    });</script>

<script>

    $('input.order').change(function () {
    $(this).next().next().addClass('text-warning');
    $(this).addClass('text-warning');
    });
    // disable form submit with Enter Key
    $('input.order').on('keyup keypress', function (e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
    e.preventDefault();
    return false;
    }
    });
    // start ajax
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    // ajax reorder posts
    $('.order-submit').click(function (e) {

    e.preventDefault();
    var order = $(this).closest('form').find('input[name=order]').val();
    var id = $(this).closest('form').find('input[name=orderid]').val();
    var selectedbutton = $(this);
    var selectedinput = $(this).closest('form').find('input[name=order]');
    $.ajax({

    type: 'POST',
            url: '{{ route('adminpostreorder') }}',
            data: {order: order, id: id},
            success: function (response) {

            if (response.success) {
            $(selectedinput).removeClass('text-warning text-danger is-invalid').addClass('text-success is-valid');
            $(selectedbutton).removeClass('text-warning text-danger').addClass('text-success');
            setTimeout(function () {
            $(selectedinput).removeClass('text-success is-valid').fadeOut('fast');
            $(selectedbutton).removeClass('text-success').fadeOut('fast');
            }, 1200);
            }
            else if (response.error) {
            $(selectedinput).addClass('text-danger is-invalid').fadeIn('slow');
            $(selectedbutton).addClass('text-danger').fadeIn('slow');
            alert(response.error);
            }

            }
    });
    });
    // ajax activate posts
    $('.activatepost').click(function (e) {

    e.preventDefault();
    //
    $(this).addClass('text-warning');
    //
    var id = $(this).next('input[name=activateid]').val();
    var currentelement = $(this);
    if ($(this).hasClass('active')) {
    var activestatus = 1;
    var setactive = 0;
    } else if ($(this).hasClass('inactive')) {
    var activestatus = 0;
    var setactive = 1;
    }

    $.ajax({

    type: 'POST',
            url: '{{ route('adminactivatepost') }}',
            data: {active: setactive, id: id},
            success: function (response) {

            if (response.success) {
            if (response.state == 0) {
            $(currentelement).addClass('fa-eye-slash inactive').removeClass('fa-check active text-warning');
            $(currentelement).closest('tr').addClass('gray-out');
            } else if (response.state == 1) {
            $(currentelement).addClass('fa-check active').removeClass('fa-eye-slash inactive text-warning');
            $(currentelement).closest('tr').removeClass('gray-out');
            }
            }
            else if (response.error) {
            alert(response.error);
            }

            }
    });
    });

</script>
@endpush

