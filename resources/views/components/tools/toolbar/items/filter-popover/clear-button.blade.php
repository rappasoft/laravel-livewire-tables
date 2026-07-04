@aware(['isTailwind','isBootstrap','isBootstrap4','isBootstrap5', 'localisationPath'])

@if($isBootstrap)
    <button
        type="button"
        wire:click.prevent="setFilterDefaults"
        x-on:click="filterPopoverOpen = false"
        class="lwt-clear-btn"
    >
        <i class="bi bi-x-circle" aria-hidden="true"></i>
        <span>{{ __($localisationPath.'Clear') }}</span>
    </button>
@else
    <button type="button" wire:click.prevent="setFilterDefaults" x-on:click="filterPopoverOpen = false"
        class="w-full inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:hover:border-gray-500 dark:hover:bg-gray-600">
        {{ __($localisationPath.'Clear') }}
    </button>
@endif
