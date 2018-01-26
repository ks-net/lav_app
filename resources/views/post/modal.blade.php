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
                <nav class="nav mb-3 justify-content-center justify-content-md-start">
                    <a href="{{route('adminpostcreate')}}" class="btn btn-success d-md-inline">
                        @lang_ucw('common.create_new_post')
                        <i class="fa fa-plus-circle"></i>
                    </a>
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
                    <div class="col-md-6 col-sm-12 p-2  text-center text-md-left">
                        <span class="badge badge-secondary">{{$posts->total()}}</span> <span class="">@lang_ucw('common.total_posts')</span>
                    </div>
                    <div class="col-md-6 col-sm-12  text-right">
                        <form action="{{route('adminpostdeletemany')}}" method="post" name="deletechecked" id="deletechecked">
                            {!! csrf_field() !!}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn  btn-sm btn-default d-none d-md-inline " onclick="return confirm('{{__('common.confirm_delete_checked_records')}}')">
                                <i class="fa fa-times-circle"></i> @lang_ucw('common.delete_checked')
                            </button>
                        </form>
                    </div>
                    <div class="d-none d-md-block">
                        <div class="d-inline">{{ $posts->appends(\Request::except('page'))->render('resources.vendor.pagination.table-top-bootstrap-4') }}</div>
                        <div class="small d-none d-sm-inline-block">
                            ({{__('pagination.page')}} {{ $posts->currentPage() }} {{__('pagination.page_from')}} {{ $posts->lastPage() }} {{__('pagination.pages')}})
                        </div>
                    </div>
                </div>
                @endif
            </div>

            @if (count($posts) > 0)
            <!-- Table -->
            <table class="table table-hover table-striped" style="background:#fff;">
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
                        <th scope="col">
                            @sortablelink('active', __('common.short_active'))
                        </th>
                        <th scope="col" class="d-none d-md-table-cell">
                            @sortablelink('created_at', __('common.short_created_at'))
                        </th>
                        <th scope="col" class="d-none d-md-table-cell">
                            @sortablelink('updated_at', __('common.short_updated_at'))
                        </th>
                        <th scope="col">
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
                            <span class=" ">{{ $post->id }}</span>
                        </th>
                        <td style="border-left:1px dashed #ddd;max-width:640px;">
                            <span class="{{ $post->active === 1 ? '' : 'gray-out' }}">
                                {{ str_limit($post->title , config('settings.admin_title_trim') , '...') }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class=" ">
                                <i class="fa {{ $post->active === 1 ? 'fa-check' : 'fa-eye-slash gray-out' }}"></i>
                            </span>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="small {{ $post->active === 1 ? '' : 'gray-out' }}">{{ $post->created_at }}</span>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="small {{ $post->active === 1 ? '' : 'gray-out' }}">{{ $post->updated_at }}</span>
                        </td>
                        <td class="text-center">
                            <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block"
                               href="{{ route('adminpostedit', $post->id) }}"
                               title="@lang_ucw('common.edit')">
                                <i class="fa fa-pencil"></i>
                            </a> &nbsp;
                            <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block"
                               href="{{url('post/'.$post->seotitle)}}"
                               title="@lang_ucw('common.display')">
                                <i class="fa fa-eye"></i>
                            </a> &nbsp;
                            <form name="deletepost{{ $post->id }}" action="{{ route('adminpostdelete', $post->id) }}" method="post" style="display:none;">
                                {!! csrf_field() !!}
                                {{ method_field('DELETE') }}
                            </form>
                            <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block"
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

@push ('bottom-scripts')
@endpush


<script>
$(document).ready(function() {

        $("#checkall").change(function() {
            if($(this).on(":checked")) {
        var checkBoxes = $("input[name=deletechecked\\[\\]]");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
            }

            if ($('input.deletechecked').is(':checked')) {
                $('input.deletechecked').parent().parent().addClass('table-warning');
            }else {
                $('input.deletechecked').parent().parent().removeClass('table-warning');
            }

        });

    $('input.deletechecked').change(function(){
        if($(this).is(":checked")) {
            $(this).parent().parent().addClass('table-warning');
        } else {
            $(this).parent().parent().removeClass('table-warning');
        }
    });

 });
</script>

<script>
    $('a.page-link').on('click', function (event) {
    event.preventDefault();
    var page = $(this).attr('href');
    console.log(page);
    alert('hai');
});
</script>





