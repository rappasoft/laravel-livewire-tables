---
title: Other Column Types
weight: 4
---

## Boolean Columns

Boolean columns are good if you have a column type that is a true/false, or 0/1 value.

For example:

```php
BooleanColumn::make('Active')
```

Would yield:

![Boolean Column](https://imgur.com/LAk6gHY.png)

### Using your own view

If you don't want to use the default view and icons you can set your own:

```php
BooleanColumn::make('Active')
    ->view('my.active.view')
```

You will have access to `$component`, `$status`, and `$successValue`.

To help you better understand, this is the Tailwind implementation of BooleanColumn:

```html
@if ($status)
    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-5 w-5 @if ($successValue === true) text-green-500 @else text-red-500 @endif" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
@else
    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-5 w-5 @if ($successValue === false) text-green-500 @else text-red-500 @endif" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
@endif
```

### Setting the truthy value

If you want the false value to be the green option, you can set:

```php
BooleanColumn::make('Active')
    ->setSuccessValue(false) // Makes false the 'successful' option
```

That would swap the colors of the icons in the image above.

### Setting the status value

By default, the `$status` is set to:

```php
(bool)$value === true
```

You can override this functionality:

```php
BooleanColumn::make('Active')
    ->setCallback(function(string $value) {
        // Figure out what makes $value true
    })
```

## Image Columns

Image columns provide a way to display images in your table without having to use `format()` or partial views:

```php
ImageColumn::make('Avatar')
    ->location(function($row) {
        return storage_path('app/public/avatars/' . $row->id . '.jpg');
    })
```

You may also pass an array of attributes to apply to the image tag:

```php
ImageColumn::make('Avatar')
    ->location(function($row) {
        return storage_path('app/public/avatars/' . $row->id . '.jpg');
    })
    ->attributes(function($row) {
        return [
            'class' => 'rounded-full',
            'alt' => $row->name . ' Avatar',
        ];
    })
```

## Link Columns

Link columns provide a way to display HTML links in your table without having to use `format()` or partial views:

```php
LinkColumn::make('Action')
    ->title(fn($row) => 'Edit')
    ->location(fn($row) => route('admin.users.edit', $row))
```

You may also pass an array of attributes to apply to the `a` tag:

```php
LinkColumn::make('Action')
    ->title(fn($row) => 'Edit')
    ->location(fn($row) => route('admin.users.edit', $row))
    ->attributes(function($row) {
        return [
            'class' => 'rounded-full',
            'alt' => $row->name . ' Avatar',
        ];
    })
```