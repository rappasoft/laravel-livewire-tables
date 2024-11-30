@php
    $defaultValue = ($filter->hasFilterDefaultValue() ? (bool) $filter->getFilterDefaultValue() : false)
@endphp
<div class="flex flex-cols"
    x-data="newBooleanFilter('{{ $filter->getKey() }}', '{{ $tableName }}', '{{ $defaultValue }}')"
>
    <x-livewire-tables::tools.filter-label :$filter :$filterLayout :$tableName :$isTailwind :$isBootstrap4 :$isBootstrap5 :$isBootstrap />
    <input id="thisId" type="checkbox" name="switch" class="hidden" :checked="value" />

    <button id="{{ $tableName }}-filter-{{ $filter->getKey() }}"
        x-ref="switchButton"
        type="button"
        @click="toggleStatusWithUpdate"
        :class="(value == 1 || value == true)  ? 'bg-blue-600' : 'bg-neutral-200'"
        class="relative inline-flex h-6 py-0.5 ml-4 focus:outline-none rounded-full w-10"
        x-cloak>
        <span :class="(value == 1 || value == true) ? 'translate-x-[18px]' : 'translate-x-0.5'" class="w-5 h-5 duration-200 ease-in-out bg-white rounded-full shadow-md"></span>
    </button>
    <template x-if="(value == 1 || value == true)">
        <button @click="toggleStatusWithReset" type="button"
            class="flex-shrink-0 ml-1 h-6 w-6 rounded-full inline-flex items-center justify-center text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:outline-none focus:bg-indigo-500 focus:text-white"
        >

            <span class="sr-only">{{ __($localisationPath.'Remove filter option') }}</span>
            <x-heroicon-m-x-mark class="h-6 w-6" />
        </button>
    </template>
</div>
