@if ($paginationEnabled && $models->count())
    <div class="row">
        <div class="col">
            {{ $models->links() }}
        </div>

        <div class="col text-right text-muted">
            {{ __('Showing :first to :last out of :total results', ['first' => $models->count() ? $models->firstItem() : 0, 'last' => $models->count() ? $models->lastItem() : 0, 'total' => $models->total()]) }}
        </div>
    </div>
@endif
