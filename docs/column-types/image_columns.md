---
title: Image Columns
weight: 9
---
## Image Columns

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
