@if ($paginationEnabled)
    <div class="row">
        <div class="col">
            {{ $models->links() }}
        </div>

        <div class="col text-right text-muted">
            {{ __('Showing :first to :last out of :total results', ['first' => $models->firstItem(), 'last' => $models->lastItem(), 'total' => $models->total()]) }}
        </div>
    </div>
@endif
