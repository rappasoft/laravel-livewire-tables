@if ($this->showActions)
    <div class="w-full md:flex md:flex-nowrap mb-4 md:mb-0 md:space-x-1 space-y-1 md:space-y-0">
        @foreach($this->actions as $action => $title)
            <button
                wire:click="{{ $action }}"
                wire:key="button-{{ $action }}"
                type="button"
                class="whitespace-nowrap w-full md:w-auto focus:outline-none inline-flex justify-center items-center transition-all ease-in duration-100 focus:ring-2 focus:ring-offset-2 hover:shadow-sm disabled:opacity-80 disabled:cursor-not-allowed rounded gap-x-2 text-sm px-4 py-2 ring-secondary-500 text-white bg-secondary-500 hover:bg-secondary-600 hover:ring-secondary-600 dark:ring-offset-slate-800 dark:bg-secondary-700 dark:ring-secondary-700 dark:hover:bg-secondary-600 dark:hover:ring-secondary-600"
            >
                <span>{{ $title }}</span>
            </button>
        @endforeach
    </div>
@endif
