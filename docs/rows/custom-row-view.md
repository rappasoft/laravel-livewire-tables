---
title: Custom Row View
weight: 2
---

If you would like full control over your rows without using the Column formatter, then you can define a `rowView` and return the string to the view to render the rows. The view will be passed the current `$row`.

The string is just passed to a regular Laravel `@include()` so it starts at the resources/views directory which you do not need to specify.

```php
public function rowView(): string
{
     // Becomes /resources/views/location/to/my/row.blade.php
     return 'location.to.my.row.view';
}
```

**Note:** You do not need to wrap in a `<tr>` as you are only specifying your cells in order as they appear in your `columns()` array. This leaves room for the component to add extra columns as needed such in the case of bulk exports.

```html
<x-livewire-tables::table.cell> // Note: Tailwind Specific, see below.
    {{ ucfirst($row->type) }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->name }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @if ($row->isAdmin())
        @lang('All')
    @elseif (! $row->permissions->count())
        @lang('None')
    @else
        {!! collect($row->permissions->pluck('description'))->implode('<br/>') !!}
    @endif
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @if(! $row->isAdmin())
        <a href="{{ route('admin.auth.role.edit', $row) }}" class="text-primary-600 font-medium hover:text-primary-900">Manage</a>
    @else
        <span>-</span>
    @endif
</x-livewire-tables::table.cell>
```

The row view will be passed the current model named as `$row`.

## Using the included blade components in the row view

To create cells, you should use the `<x-livewire-tables::table.cell>` table cell component, which will be rendered to:

```html
<td {{ $attributes->merge(['class' => 'px-3 py-2 md:px-6 md:py-4 whitespace-no-wrap text-sm leading-5 text-gray-900']) }}>
    {{ $slot }}
</td>
```

Note: The default `x-livewire-tables::table.row` and `x-livewire-tables::table.cell` default to Tailwind, for Bootstrap specific versions use `x-livewire-tables::bs4.table.row` and `x-livewire-tables::bs4.table.cell` for Bootstrap 4, or `x-livewire-tables::bs5.table.row` and `x-livewire-tables::bs5.table.cell` for Bootstrap 5.

There is also a Tailwind alias of `x-livewire-tables::tw.table.row` and `x-livewire-tables::tw.table.cell` if you want to be specific.

The helpers are generally more for Tailwind users, as Bootstrap does not have any default added classes to their rows or cells currently, you can substitute regular `<tr>` and `<td>` if you prefer. Though if any formatting is added in the future, you may have to refactor.

You are free to publish and change these views as needed.

**Note:** Using `rowView` will supersede any column formatting.
