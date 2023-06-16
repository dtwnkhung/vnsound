@if ($paginator->hasPages())

    <div class="news_pagination">
        <ul>

            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <a href="javascript:void(0)">
                        <img src="images/tin-tuc/ic-1.png" alt="" />
                    </a>
                </li>
            @else
                <li class="">
                    <a href="{{ $paginator->previousPageUrl() }}">
                        <img src="images/tin-tuc/ic-1.png" alt="" />
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)

                    @if (is_string($element))
                        <li class="disabled">
                            <a href="javascript:void(0)">
                                {{ $element }}
                            </a>
                        </li>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active my-active"><a href="javascript:void(0)">{{ $page }}</a></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li class="disabled"><a href="{{ $paginator->nextPageUrl() }}"><img src="images/tin-tuc/ic-2.png" alt="" /></a></li>
                @else
                    <li class="disabled"><a href="javascript:void(0)"><img src="images/tin-tuc/ic-2.png" alt="" /></a></li>
                @endif
        </ul>
    </div>
@endif 