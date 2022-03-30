---
title: Secondary Header
weight: 6
---

A secondary header is a body table row underneath the `thead` that can serve whatever purpose you need. It is passed the current rows of the table at the time so you can use it to tally numbers or show messages based on those rows.

Here is you how define a secondary header for a column:

```php
Column::make('Price')
    ->sortable()
    ->secondaryHeader(function($rows) {
        return 'Subtotal: ' . $rows->sum('price');
    }),
```

The secondary header row is enabled when ever any column calls `secondaryHeader`.

See also [secondary header component configuration](../secondary-header/available-methods).

## Example: Adding a column search

Column search is not built in by default, but is easily achievable using this feature.

Here are the steps you need to take:

1. Add state to the component to track the input values
2. Add the inputs to the columns using the secondaryHeader method
3. Add the clause to the query based on the new state
4. Optionally, add the state to the query string to preserve it on page load.

### 1. Add state to the component to track the input values

This can be called whatever you want, but you need an array to house the values of the column search fields:

```php
public $columnSearch = [
    'name' => null,
];
```

### 2. Add the inputs to the columns using the secondaryHeader method

You can do this inline, but I'll break it out into a partial for clarity:

```php
Column::make('Name')
    ->sortable()
    ->searchable()
    ->asHtml()
    ->secondaryHeader(function() {
        return view('tables.cells.input-search', ['field' => 'name']);
    }),
```

**input-search.blade.php**

```html
<input type="text" wire:model.debounce="columnSearch.{{ $field }}" placeholder="Search {{ ucfirst($field) }}" class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md" />
```

### 3. Add the clause to the query based on the new state

Now you need to tell the query what to do when something is typed into the search:

```php
public function query()
{
    return User::query()
        ->when($this->columnSearch['name'] ?? null, fn ($query, $name) => $query->where('name', 'like', '%' . $name . '%'));
}
```

### Extra: Add a clear button to the inputs

If you want the input to have a clear button when it has a value like the default search does:

1. Send the state to the partial

```php
Column::make('Name')
    ->sortable()
    ->searchable()
    ->asHtml()
    ->secondaryHeader(function() {
        return view('tables.cells.input-search', ['field' => 'name', 'columnSearch' => $this->columnSearch]);
    }),
```

2. Copy the search field and modify:

```html
<div class="flex rounded-md shadow-sm">
    <input
        wire:model.debounce="columnSearch.{{ $field }}"
        placeholder="Search {{ ucfirst($field) }}"
        type="text"
        class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600 @if (isset($columnSearch[$field]) && strlen($columnSearch[$field])) rounded-none rounded-l-md focus:ring-0 focus:border-gray-300 @else focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md @endif"
    />

    @if (isset($columnSearch[$field]) && strlen($columnSearch[$field]))
        <span wire:click="$set('columnSearch.{{ $field }}', null)" class="inline-flex items-center px-3 text-gray-500 bg-gray-50 rounded-r-md border border-l-0 border-gray-300 cursor-pointer sm:text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </span>
    @endif
</div>
```