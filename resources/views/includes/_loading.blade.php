@if ($searchEnabled && $loadingIndicator)
    <div class="text-center mt-3 mb-3" wire:loading wire:target="search">
        {{ $loadingMessage }}
    </div>
@endif
