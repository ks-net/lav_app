<?php

/*
 *  File:table-top-bootstrap-4.blade.php  encoding:UTF-8
 *  Created at 01-23-2018 (mm/dd/yyyy) 19:36:44
 *  Belongs to project:lav_app
 *  Copyright © 2018  @KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */
?>

@if ($paginator->hasPages())

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="btn btn-sm btn-light disabled">@lang('pagination.previous')</span>
        @else
            <a class="btn btn-sm btn-light" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous_page')</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="btn btn-sm btn-light" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next_page')</a>
        @else
            <span class="btn btn-sm btn-light disabled">@lang('pagination.next')</span>
        @endif

@endif