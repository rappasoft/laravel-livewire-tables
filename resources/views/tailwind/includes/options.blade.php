@if ($paginationEnabled || $searchEnabled)
    <div class="pb-3  sm:flex sm:items-center sm:justify-between">
        <div class="sm:mt-3 sm:ml-3">
            <label for="search_candidate" class="sr-only">Search</label>
            <div class="flex rounded-md">
                <div class="relative flex-grow focus-within:z-10">
                    @if ($searchEnabled)
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <!-- Heroicon name: solid/search -->
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                            </svg>

                        </div>
                        <input
                            @if (is_numeric($searchDebounce) && $searchUpdateMethod === 'debounce') wire:model.debounce.{{ $searchDebounce }}ms="search" @endif
                        @if ($searchUpdateMethod === 'lazy') wire:model.lazy="search" @endif
                            @if ($disableSearchOnLoading) wire:loading.attr="disabled" @endif
                            class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 pr-10 sm:text-sm border-gray-300 rounded-md"
                            type="text"
                            placeholder="{{ __('laravel-livewire-tables::strings.search') }}"
                        />
                        @if ($clearSearchButton)
                            <div wire:click="clearSearch" class="absolute inset-y-0 right-0 pr-3 flex items-center pointer">
                                <svg class="h-4 w-4 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                        @endif

                    @endif

                </div>

            </div>
        </div>
        <div class="flex">
            @if ($paginationEnabled && count($perPageOptions))
                <div class="sm:mt-3 flex w-400 justify-end mr-3">
                    <div class="flex items-center">
                        @lang('laravel-livewire-tables::strings.per_page'): &nbsp;
                    </div>
                    <select wire:model="perPage" class="max-w-lg flex-1 focus:ring-indigo-500 focus:border-indigo-500 w-full sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @foreach ($perPageOptions as $option)
                            <option>{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.export')
            @if($addRoute)
                <a href="{{  route($addRoute) }} " type="button" class="inline-flex mr-3 sm:mt-3 items-center px-2 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <!-- Heroicon name: solid/mail -->
                        <svg class=" h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                </a>
            @endif
        </div>

    </div>
@endif
