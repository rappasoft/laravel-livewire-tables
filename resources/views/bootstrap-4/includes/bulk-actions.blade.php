@if (count($bulkActions))
    <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" id="bulkActions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('Bulk Actions') }}
        </button>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bulkActions">
            @foreach($bulkActions as $action => $title)
                <a href="#" wire:click.prevent="{{ $action }}" class="dropdown-item">{{ $title }}</a>
            @endforeach
        </div>
    </div>
@endif
