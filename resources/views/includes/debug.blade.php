<div>
    @if ($this->debugIsEnabled())
        <p><strong>@lang('livewire-tables::Debugging Values'):</strong></p>

        @if (! app()->runningInConsole())
            <div class="mb-4">@dump((new \Rappasoft\LaravelLivewireTables\DataTransferObjects\DebuggableData($this))->toArray())</div>
        @endif
    @endif
</div>
