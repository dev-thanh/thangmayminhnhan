@if ($paginator->hasPages())
    <!-- Pagination -->
        <ul class="pagination" style="margin: 0px;" role="navigation">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}">
                        <span><i class="fa fa-angle-double-left"></i></span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a href="{{ $url }}">{{ $page }}</a></li>
                        @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @elseif ($page == $paginator->lastPage() - 1 || $page == $paginator->lastPage() - 2 || $paginator->currentPage())
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}">
                    <span><i class="fa fa-angle-double-right"></i></span>
                </a>
            </li>
            @endif
        </ul>
    <!-- Pagination -->
@endif
