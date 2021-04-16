@if ($showPagination)
    <div class="row">
        <div class="col-12 col-md-6">
            {{ $rows->links() }}
        </div>

        <div class="col-12 col-md-6 text-center text-md-right text-muted">
            @lang('Showing :first to :last out of :total results', [
                'first' => $rows->count() ? $rows->firstItem() : 0,
                'last' => $rows->count() ? $rows->lastItem() : 0,
                'total' => $rows->total()
            ])
        </div>
    </div>
@endif
