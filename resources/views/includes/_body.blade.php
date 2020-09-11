@if ($loadingIndicator)
    <tbody wire:loading>
        <tr><td colspan="{{ collect($columns)->count() }}">@lang('laravel-livewire-tables::strings.loading')</td></tr>
    </tbody>

    <tbody wire:loading.remove>
@else
    <tbody>
@endif
    @if($models->isEmpty())
        <tr><td colspan="{{ collect($columns)->count() }}">@lang('laravel-livewire-tables::strings.no_results')</td></tr>
    @else
        @foreach($models as $model)
            <tr
                class="{{ $this->setTableRowClass($model) }}"
                id="{{ $this->setTableRowId($model) }}"
                @foreach ($this->setTableRowAttributes($model) as $key => $value)
                    {{ $key }}="{{ $value }}"
                @endforeach
                @if ($this->getTableRowUrl($model))
                    onclick="window.location='{{ $this->getTableRowUrl($model) }}';"
                    style="cursor:pointer"
                @endif
            >
                @if($checkbox && $checkboxLocation === 'left')
                    @include('laravel-livewire-tables::includes._checkbox-row')
                @endif

                @foreach($columns as $column)
                    @if (!$column->isHidden())
                        <td
                            class="{{ $this->setTableDataClass($column->attribute, Arr::get($model->toArray(), $column->attribute)) }}"
                            id="{{ $this->setTableDataId($column->attribute, Arr::get($model->toArray(), $column->attribute)) }}"
                            @foreach ($this->setTableDataAttributes($column->attribute, Arr::get($model->toArray(), $column->attribute)) as $key => $value)
                                {{ $key }}="{{ $value }}"
                            @endforeach
                        >
                            @include('laravel-livewire-tables::includes._column-data')
                        </td>
                    @endif
                @endforeach

                @if($checkbox && $checkboxLocation === 'right')
                    @include('laravel-livewire-tables::includes._checkbox-row')
                @endif
            </tr>
        @endforeach
    @endif
</tbody>
