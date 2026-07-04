@aware(['isTailwind', 'isBootstrap', 'localisationPath'])

@if($isBootstrap)
    <div class="lwt-search" role="search" wire:key="lwt-search-wrapper">
        <span class="lwt-search__icon" aria-hidden="true">
            <i class="bi bi-search"></i>
        </span>

        <input
            wire:model{{ $this->getSearchOptions() }}="search"
            type="text"
            class="lwt-search__input"
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
                <i class="bi bi-x-lg" aria-hidden="true"></i>
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
