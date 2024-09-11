@if ($paginator->lastPage() != 1)
<div id="pagination">
    <div class="containerPaginator">
        <div class="divPaginator">
            <button class="bottoniPaginatorNoLink">{{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} di {{ $paginator->total() }}</button>
        </div>
        
        <!-- Link alla prima pagina -->
        @if (!$paginator->onFirstPage())
            <div class="divPaginator"><a href="{{ $paginator->url(1) }}"><button class="bottoniPaginator">Inizio</button></a></div>
        @else
            <div class="divPaginator"><button class="bottoniPaginatorNoLink">Inizio</button></div>
        @endif
        
        <!-- Link alla pagina precedente -->
        @if ($paginator->currentPage() != 1)
            <div class="divPaginator"><a href="{{ $paginator->previousPageUrl() }}"><button class="bottoniPaginator">Precedente</button></a></div>
        @else
            <div class="divPaginator"><button class="bottoniPaginatorNoLink">Precedente</button></div>
        @endif
        
        <!-- Link alla pagina successiva -->
        @if ($paginator->hasMorePages())
            <div class="divPaginator"><a href="{{ $paginator->nextPageUrl() }}"><button class="bottoniPaginator">Successiva</button></a></div>
        @else
            <div class="divPaginator"><button class="bottoniPaginatorNoLink">Successiva</button></div>
        @endif
        
        <!-- Link all'ultima pagina -->
        @if ($paginator->hasMorePages())
            <div class="divPaginator"><a href="{{ $paginator->url($paginator->lastPage()) }}"><button class="bottoniPaginator">Fine</button></a></div>
        @else
            <div class="divPaginator"><button class="bottoniPaginatorNoLink">Fine</button></div>
        @endif
    </div>
</div>
@endif
