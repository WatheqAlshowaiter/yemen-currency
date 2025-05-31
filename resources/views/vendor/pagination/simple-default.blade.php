<div class="pagination-container">
    @if ($paginator->hasPages())
        <nav class="pagination-nav" role="navigation" aria-label="صفحات أسعار الصرف">
            @if ($paginator->onFirstPage())
                <span class="pagination-disabled">
                    🚫 
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" 
                   class="pagination-link arrow-right" 
                   rel="prev">
                    الأسعار التالية
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" 
                   class="pagination-link arrow-left" 
                   rel="next">
                    الأسعار السابقة
                </a>
            @else
                <span class="pagination-disabled arrow-left">
                    الأسعار السابقة
                </span>
            @endif
        </nav>
    @endif
</div>