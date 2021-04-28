@if ($paginationEnabled && $showPerPage && $rows->lastPage() > 1)
    <div class="row">
        <div class="col-12 col-md-6">
            {{ $rows->links() }}
        </div>

        <div class="col-12 col-md-6 text-center text-md-end text-muted">
            @lang('Showing')
            <strong>{{ $rows->count() ? $rows->firstItem() : 0 }}</strong>
            @lang('to')
            <strong>{{ $rows->count() ? $rows->lastItem() : 0 }}</strong>
            @lang('of')
            <strong>{{ $rows->total() }}</strong>
            @lang('results')
        </div>
    </div>
@else
    <div class="row">
        <div class="col-12 text-muted">
            @lang('Showing')
            <strong>{{ $rows->count() }}</strong>
            @lang('results')
        </div>
    </div>
@endif
