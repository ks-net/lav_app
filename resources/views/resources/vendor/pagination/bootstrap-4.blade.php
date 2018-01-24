@if ($paginator->hasPages())
    <ul class="pagination  flex-wrap justify-content-center justify-content-sm-start">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo; <span class="d-inline d-sm-none">{{__('pagination.previous')}}</span></span></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; <span class="d-inline d-sm-none">{{__('pagination.previous')}}</span></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled d-none d-sm-inline-block"><span class="page-link  d-none d-sm-inline-block">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active d-none d-sm-inline"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item d-none d-sm-inline"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><span class="d-inline d-sm-none">{{__('pagination.next')}}</span> &raquo;</a></li>
        @else
            <li class="page-item disabled"><span class="page-link"><span class="d-inline d-sm-none">{{__('pagination.previous')}}</span> &raquo;</span></li>
        @endif
    </ul>
@endif
