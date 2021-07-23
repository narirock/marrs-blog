<div class="paginate-box bg-light">
    <div class="block-27">
        <ul>
            @if ($paginator->onFirstPage())
                <li class="active"><a href="javascript:;">&lt;</a></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" title="Anterior">&lt;</a></li>
            @endif
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><a href="javascript:;">{{ $element }}</a></li>
                @endif

                <!-- Array Of Links -->
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif

            @endforeach

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" title="Próxima">&gt;</a></li>
            @else
                <li class="active"><a href="javascript:;">&gt;</a></li>
            @endif
        </ul>
    </div>
</div>
