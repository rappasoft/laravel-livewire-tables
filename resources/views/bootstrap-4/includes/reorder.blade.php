@if ($reorderEnabled)
    <div class="mr-0 mr-md-2 mb-3 mb-md-0">
        <button
            wire:click="{{ $reordering ? 'disableReordering' : 'enableReordering' }}"
            type="button"
            class="btn btn-default d-block w-100 d-md-inline"
        >
            @if ($reordering)
                @lang('Done Reordering')
            @else
                @lang('Reorder')
            @endif
        </button>
    </div>
@endif
