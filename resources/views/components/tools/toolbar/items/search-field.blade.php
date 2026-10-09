@aware(['tableName', 'isTailwind', 'isBootstrap', 'localisationPath'])

@if($isBootstrap)
    <div @class(['lwt-search', 'lwt-search--icon' => $this->hasSearchIcon]) role="search" wire:key="{{ $tableName }}-search-wrapper">
        @if($this->hasSearchIcon)
            <span class="lwt-search__icon" aria-hidden="true">
                @svg($this->getSearchIcon, $this->getSearchIconClasses, $this->getSearchIconOtherAttributes)
            </span>
        @endif

        <input
            wire:model{{ $this->getSearchOptions() }}="search"
            type="text"
            {{ $attributes->merge($this->getSearchFieldAttributes())
                ->class(['lwt-search__input' => ($this->getSearchFieldAttributes()['default'] ?? true) || ($this->getSearchFieldAttributes()['default-styling'] ?? true)])
                ->except(['default', 'default-styling', 'default-colors']) }}
            placeholder="{{ $this->getSearchPlaceholder() }}"
            aria-label="{{ $this->getSearchPlaceholder() }}"
            autocomplete="off"
        />

        @if ($this->hasSearch())
            <button
                type="button"
                wire:click="clearSearch"
                class="lwt-search__clear"
                aria-label="{{ __($localisationPath.'Clear') }}"
            >
                <x-heroicon-m-x-mark class="lwt-btn__icon" aria-hidden="true" />
            </button>
        @endif
    </div>
@else
    <div
        @class([
            'rounded-md shadow-sm' => $isTailwind,
            'flex' => ($isTailwind && !$this->hasSearchIcon),
            'relative inline-flex flex-row' => $this->hasSearchIcon,
        ])>

        @if($this->hasSearchIcon)
            <x-livewire-tables::tools.toolbar.items.search.icon :searchIcon="$this->getSearchIcon" :searchIconClasses="$this->getSearchIconClasses" :searchIconOtherAttributes="$this->getSearchIconOtherAttributes"  />
        @endif

        <x-livewire-tables::tools.toolbar.items.search.input />

        @if ($this->hasSearch)
            <x-livewire-tables::tools.toolbar.items.search.remove />
        @endif
    </div>
@endif
