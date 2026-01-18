---
title: Wire Link Column (beta)
weight: 17
---

WireLink columns provide a way to display Wired Links in your table without having to use `format()` or partial views, with or without a Confirmation Message

WireLinkColumn requires title, and an "action", which must be a valid LiveWire method in the current class, or a global method

Without a Confirmation Message
```php
    WireLinkColumn::make("Delete Item")
        ->title(fn($row) => 'Delete Item')
        ->action(fn($row) => 'delete("'.$row->id.'")'),
```

You may also pass a string to "confirmMessage", which will utilise LiveWire 3's "wire:confirm" approach to display a confirmation modal.

```php
    WireLinkColumn::make("Delete Item")
        ->title(fn($row) => 'Delete Item')
        ->confirmMessage('Are you sure you want to delete this item?')
        ->action(fn($row) => 'delete("'.$row->id.'")')
        ->attributes(fn($row) => [
            'class' => 'btn btn-danger',
        ]),
```

And you may also pass an array of attributes, which will be applied to the "button" element used within the Column
```php
    WireLinkColumn::make("Delete Item")
        ->title(fn($row) => 'Delete Item')
        ->action(fn($row) => 'delete("'.$row->id.'")')
        ->attributes(fn($row) => [
            'class' => 'btn btn-danger',
        ]),
```

## Icons

You can add icons to the left and/or right of the button text using the `setIconLeft()` and `setIconRight()` methods:

```php
    WireLinkColumn::make("Delete Item")
        ->title(fn($row) => 'Delete Item')
        ->action(fn($row) => 'delete("'.$row->id.'")')
        ->setIconLeft('heroicon-o-trash'),
```

You can also add icons on both sides:
```php
    WireLinkColumn::make("View Details")
        ->title(fn($row) => 'View')
        ->action(fn($row) => 'viewDetails("'.$row->id.'")')
        ->setIconLeft('heroicon-o-eye')
        ->setIconRight('heroicon-o-chevron-right'),
```

The `setIcon()` method is an alias for `setIconRight()`:
```php
    WireLinkColumn::make("Delete Item")
        ->title(fn($row) => 'Delete Item')
        ->action(fn($row) => 'delete("'.$row->id.'")')
        ->setIcon('heroicon-o-trash'),
```

### Icon Attributes

You can customize icon attributes individually or for both icons:

```php
    WireLinkColumn::make("Delete Item")
        ->title(fn($row) => 'Delete Item')
        ->action(fn($row) => 'delete("'.$row->id.'")')
        ->setIconLeft('heroicon-o-trash')
        ->setIconLeftAttributes(['class' => 'w-4 h-4 mr-2']),
```

```php
    WireLinkColumn::make("View Details")
        ->title(fn($row) => 'View')
        ->action(fn($row) => 'viewDetails("'.$row->id.'")')
        ->setIconLeft('heroicon-o-eye')
        ->setIconRight('heroicon-o-chevron-right')
        ->setIconLeftAttributes(['class' => 'w-4 h-4 mr-2'])
        ->setIconRightAttributes(['class' => 'w-4 h-4 ml-2']),
```

To set the same attributes for both icons:
```php
    WireLinkColumn::make("Action")
        ->title(fn($row) => 'Action')
        ->action(fn($row) => 'doAction("'.$row->id.'")')
        ->setIconLeft('heroicon-o-star')
        ->setIconRight('heroicon-o-star')
        ->setIconAttributes(['class' => 'w-5 h-5']),
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