<tbody>
    @if($models->isEmpty())
        <tr><td colspan="{{ collect($columns)->count() }}">{{ $noResultsMessage }}</td></tr>
    @else
        @foreach($models as $model)
            <tr class="{{ $this->trClass($model) }}">
                @if($checkbox && $checkboxLocation === 'left')
                    @include('laravel-livewire-tables::includes._checkbox-row')
                @endif

                @foreach($columns as $column)
                    <td class="{{ $this->tdClass($column->attribute, Arr::get($model->toArray(), $column->attribute)) }}">
                        @if ($column->isView())
                            @include($column->view)
                        @else
                            @if ($column->isHtml())
                                @if ($column->isCustomAttribute())
                                    {{ new \Illuminate\Support\HtmlString($model->{$column->attribute}) }}
                                @else
                                    {{ new \Illuminate\Support\HtmlString(Arr::get($model->toArray(), $column->attribute)) }}
                                @endif
                            @elseif ($column->isUnescaped())
                                @if ($column->isCustomAttribute())
                                    {!! $model->{$column->attribute} !!}
                                @else
                                    {!! Arr::get($model->toArray(), $column->attribute) !!}
                                @endif
                            @else
                                @if ($column->isCustomAttribute())
                                    {{ $model->{$column->attribute} }}
                                @else
                                    {{ Arr::get($model->toArray(), $column->attribute) }}
                                @endif
                            @endif
                        @endif
                    </td>
                @endforeach

                @if($checkbox && $checkboxLocation === 'right')
                    @include('laravel-livewire-tables::includes._checkbox-row')
                @endif
            </tr>
        @endforeach
    @endif
</tbody>
