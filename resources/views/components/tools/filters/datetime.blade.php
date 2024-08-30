<div>
    <x-livewire-tables::tools.filter-label :$filter :$filterLayout :$this->getTableName :$isTailwind :$isBootstrap4 :$isBootstrap5 :$isBootstrap />

    <div @class([
        "rounded-md shadow-sm" => $isTailwind,
        "mb-3 mb-md-0 input-group" => $isBootstrap,
    ])>
        <input {{ $filter->getWireMethod("filterComponents.".$filter->getKey()) }}
            wire:key="{{ $filter->generateWireKey($this->getTableName, 'datetime') }}"
            id="{{ $this->getTableName }}-filter-{{ $filter->getKey() }}@if($filter->hasCustomPosition())-{{ $filter->getCustomPosition() }}@endif"
            type="datetime-local"
            @if($filter->hasConfig('min')) min="{{ $filter->getConfig('min') }}" @endif
            @if($filter->hasConfig('max')) max="{{ $filter->getConfig('max') }}" @endif
            @if($filter->hasConfig('placeholder')) placeholder="{{ $filter->getConfig('placeholder') }}" @endif
            @class([
                "block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600" => $isTailwind,
                "form-control" => $isBootstrap,
            ])
        />
    </div>
</div>