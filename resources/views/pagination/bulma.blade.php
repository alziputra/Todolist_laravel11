@if ($paginator->hasPages())
  <nav class="pagination is-centered is-rounded is-small is-responsive" role="navigation" aria-label="pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <a class="pagination-previous" disabled>@lang('pagination.previous')</a>
    @else
      <a href="{{ $paginator->previousPageUrl() }}" class="pagination-previous">@lang('pagination.previous')</a>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next">@lang('pagination.next')</a>
    @else
      <a class="pagination-next" disabled>@lang('pagination.next')</a>
    @endif

    <ul class="pagination-list">
      {{-- Pagination Elements --}}
      @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
          <li><span class="pagination-ellipsis">&hellip;</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <li><a class="pagination-link is-current" aria-label="Page {{ $page }}"
                  aria-current="page">{{ $page }}</a></li>
            @else
              <li><a href="{{ $url }}" class="pagination-link"
                  aria-label="Goto page {{ $page }}">{{ $page }}</a></li>
            @endif
          @endforeach
        @endif
      @endforeach
    </ul>
  </nav>
@endif
