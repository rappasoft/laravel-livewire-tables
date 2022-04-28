---
title: Configurable Areas
weight: 3
---

There are certain areas of the datatable as of `v2.3` where you can include your own view files. This is good for adding additional functionality to the toolbar, for example.

## Available Methods

### setConfigurableAreas

You can use the `setConfigurableAreas` method to set the areas that you want to be configurable.

```php
public function configure(): void
{
  $this->setConfigurableAreas([
    'toolbar-left-start' => 'path.to.my.view',
    'toolbar-left-end' => 'path.to.my.view',
    'toolbar-right-start' => 'path.to.my.view',
    'toolbar-right-end' => 'path.to.my.view',
    'before-toolbar' => 'path.to.my.view',
    'after-toolbar' => 'path.to.my.view',
    'before-pagination' => 'path.to.my.view',
    'after-pagination' => 'path.to.my.view',
  ]);
}
```

**Note:** Only specify the keys you are actually implementing, otherwise you may get uneven spacing.

## Example View

Example dropdown for the toolbar:

```html
@aware(['component'])

@php
    $theme = $component->getTheme();
@endphp

@if ($theme === 'tailwind')
    <div class="w-full mb-4 md:w-auto md:mb-0">
        <div
            x-data="{ open: false }"
            @keydown.window.escape="open = false"
            x-on:click.away="open = false"
            class="relative z-10 inline-block w-full text-left md:w-auto"
            wire:key="bulk-actions-button-{{ $component->getTableName() }}"
        >
            <div>
                <span class="rounded-md shadow-sm">
                    <button
                        x-on:click="open = !open"
                        type="button"
                        class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                        aria-haspopup="true"
                        x-bind:aria-expanded="open"
                        aria-expanded="true"
                    >
                        @lang('My Dropdown')

                        <svg class="w-5 h-5 ml-2 -mr-1" x-description="Heroicon name: chevron-down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </span>
            </div>

            <div
                x-cloak
                x-show="open"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 z-50 w-full mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg md:w-48 ring-1 ring-black ring-opacity-5 focus:outline-none"
            >
                <div class="bg-white rounded-md shadow-xs dark:bg-gray-700 dark:text-white">
                    <div class="py-1" role="menu" aria-orientation="vertical">
                        <button
                            wire:click="my-action"
                            wire:key="bulk-action-my-action-{{ $component->getTableName() }}"
                            type="button"
                            class="flex items-center block w-full px-4 py-2 space-x-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 dark:text-white dark:hover:bg-gray-600"
                            role="menuitem"
                        >
                            <span>My Action 1</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif ($theme === 'bootstrap-4' || $theme === 'bootstrap-5')
    <div><!-- Implement Other Themes if needed--></div>
@endif
```

**Note:** If you don't specify the theme conditional, it will show up on every theme.

## Areas

Here are the placements for the available areas:

Toolbar Left Start
![Toolbar Left Start](https://imgur.com/eDQx67u.png)

Toolbar Left End
![Toolbar Left End](https://imgur.com/hmkfoyH.png)

Toolbar Right Start
![Toolbar Right Start](https://imgur.com/V99PQUv.png)

Toolbar Right End
![Toolbar Right End](https://imgur.com/rZgbeYO.png)

Before Toolbar
![Before Toolbar](https://imgur.com/KK9EiSM.png)

After Toolbar
![After Toolbar](https://imgur.com/VL0OGia.png)

Before Pagination
![Before Pagination](https://imgur.com/lVIGpDW.png)

After Pagination
![After Pagination](https://imgur.com/wJR2LEJ.png)