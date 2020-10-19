<div>
    @foreach ($view->options() as $key => $label)
        <div class="form-check">
            <input
                type="checkbox"
                class="form-check-input"
                name="filters.{{ $view->id }}.{{ $key }}"
                id="{{ $view->id }}-{{ $key }}"
                wire:model="filters.{{ $view->id }}.{{ $key }}"
            />
            <label class="form-check-label" for="defaultCheck1">{{ $label }}</label>
        </div>
    @endforeach
</div>
