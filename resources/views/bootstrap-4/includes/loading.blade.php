@if ($loadingIndicator)
    <tbody wire:loading.class.remove="d-none" class="d-none">
        <tr>
            <td colspan="{{ collect($columns)->count() }}">
                @lang('laravel-livewire-tables::strings.loading')
            </td>
        </tr>
    </tbody>

    <tbody @if($collapseDataOnLoading) wire:loading.remove @endif>
@else
    <tbody>
@endif
