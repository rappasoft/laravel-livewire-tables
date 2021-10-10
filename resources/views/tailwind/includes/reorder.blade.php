@if ($reorderEnabled)
<button wire:click="{{ $reordering ? 'disableReordering' : 'enableReordering' }}"
        type="button"
        class="inline-flex justify-center items-center w-full md:w-auto px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:ring {{ $this->customThemeColor ? "focus:ring-{$this->customThemeColor}-200 focus:border-{$this->customThemeColor}-300" : 'focus:ring-indigo-200 focus:border-indigo-300' }} focus:ring-opacity-50 active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
    @if ($reordering)
    @lang('Done Reordering')
    @else
    @lang('Reorder')
    @endif
</button>
@endif
