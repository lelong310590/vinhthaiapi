@if ($paginator->lastPage() > 1)

    <div class="pagination-wrapper">
        <ul class="pagination">

            {{--Previous page url--}}

            <li class="{{ ($paginator->currentPage() == 1) ? 'page-item disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url(1) }}">
                    <i class="fa fa-step-backward" aria-hidden="true"></i>
                </a>
            </li>

            <li class="{{ ($paginator->currentPage() == 1) ? 'page-item disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                    <i class="fa fa-caret-left" aria-hidden="true"></i>
                </a>
            </li>

            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <li class="{{ ($paginator->currentPage() == $i) ? 'page-item active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endfor


            {{--Next page url--}}

            <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? 'page-item disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" >
                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                </a>
            </li>

            <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? 'page-item disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url($paginator->url($paginator->lastPage())) }}" >
                    <i class="fa fa-step-forward" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
    </div>
@endif