<tbody>
    @if($models->isEmpty())
        <tr><td colspan="{{ collect($columns)->count() }}">{{ $noResultsMessage }}</td></tr>
    @else
        @foreach($models as $model)
            <tr
                class="{{ $this->setTableRowClass($model) }}"
                id="{{ $this->setTableRowId($model) }}"
                @foreach ($this->setTableRowAttributes($model) as $key => $value)
                    {{ $key }}="{{ $value }}"
                @endforeach
            >
                @if($checkbox && $checkboxLocation === 'left')
                    @include('laravel-livewire-tables::includes._checkbox-row')
                @endif

                @foreach($columns as $column)
                    <td
                        class="{{ $this->setTableDataClass($column->attribute, Arr::get($model->toArray(), $column->attribute)) }}"
                        id="{{ $this->setTableDataId($column->attribute, Arr::get($model->toArray(), $column->attribute)) }}"
                        @foreach ($this->setTableDataAttributes($column->attribute, Arr::get($model->toArray(), $column->attribute)) as $key => $value)
                            {{ $key }}="{{ $value }}"
                        @endforeach
                    >
                        @if ($column->hasComponents())
                            @if ($column->componentsAreHiddenForModel($model))
                                @if ($message = $column->componentsHiddenMessageForModel($model))
                                    {{ $message }}
                                @else
                                    &nbsp;
                                @endif
                            @else
                                @foreach($column->getComponents() as $component)
                                    @if (! $component->isHidden())
                                        @include($component->view(), ['model' => $model, 'attributes' => $component->getAttributes(), 'options' => $component->getOptions()])
                                    @endif
                                @endforeach
                            @endif
                        @elseif ($column->isView())
                            @include($column->view, [$column->getViewModelName() => $model])
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
                                    {{ data_get($model, $column->attribute) }}
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
