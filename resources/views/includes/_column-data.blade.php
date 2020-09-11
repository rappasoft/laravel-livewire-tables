@if ($column->hasComponents())
    @if ($column->componentsAreHiddenForModel($model))
        @if ($message = $column->componentsHiddenMessageForModel($model))
            {{ $message }}
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
            {{ new \Illuminate\Support\HtmlString(data_get($model, $column->attribute)) }}
        @else
            {{ new \Illuminate\Support\HtmlString(Arr::get($model->toArray(), $column->attribute)) }}
        @endif
    @elseif ($column->isUnescaped())
        @if ($column->isCustomAttribute())
            {!! data_get($model, $column->attribute) !!}
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
