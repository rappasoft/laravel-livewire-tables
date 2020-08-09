@if ($paginationEnabled)
    <div class="row">
        <div class="col">
            {{ $models->links() }}
        </div>

        <div class="col text-right text-muted">
            {{ __($shownLabel.' :first '.$toLabel.' :last '.$outOfLabel.' :total '.$resultsLable, ['first' => $models->count() ? $models->firstItem() : 0, 'last' => $models->count() ? $models->lastItem() : 0, 'total' => $models->total()]) }}
        </div>
    </div>
@endif
