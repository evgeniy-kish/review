<?php
/**
 * @var Illuminate\Pagination\LengthAwarePaginator $paginator
 */
?>
@if ($paginator->hasPages())
<div class="saasbox-pagination-area {{ $class ?? 'mb-5 mb-lg-0 mt-5' }}">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item" aria-disabled="true">
                        <a class="page-link" href="#">{{ $element }}</a>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
    </nav>
</div>
@endif