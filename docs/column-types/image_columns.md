---
title: Image Columns
weight: 11
---

Image columns provide a way to display images in your table without having to use `format()` or partial views:

```php
ImageColumn::make('Avatar')
    ->location(
        fn($row) => storage_path('app/public/avatars/' . $row->id . '.jpg')
    ),
```

You may also pass an array of attributes to apply to the image tag:

```php
ImageColumn::make('Avatar')
    ->location(
        fn($row) => storage_path('app/public/avatars/' . $row->id . '.jpg')
    )
    ->attributes(fn($row) => [
        'class' => 'rounded-full',
        'alt' => $row->name . ' Avatar',
    ]),
```

Please also see the following for other available methods:
<ul>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/available-methods">Available Methods</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/column-selection">Column Selection</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/secondary-header">Secondary Header</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/footer">Footer</a>
    </li>
</ul>