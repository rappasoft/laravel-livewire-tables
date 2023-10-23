@aware(['component', 'tableName'])
<div x-show="reorderStatus">
    <button
        x-on:click="reorderToggle"
        type="button"
        class="inline-flex justify-center items-center w-full md:w-auto px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
    >
        <span x-show="currentlyReorderingStatus">
            @lang('Cancel')
        </span>

        <span x-show="!currentlyReorderingStatus">
            @lang('Reorder')
        </span>
    </button>

    <button
        type="button"
        class="inline-flex justify-center items-center w-full md:w-auto px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
        x-show="currentlyReorderingStatus" x-on:click="updateOrderedItems">
        @lang('Save')
    </button>
</div>
