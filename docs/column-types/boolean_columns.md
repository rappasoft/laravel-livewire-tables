---
title: Boolean Columns
weight: 4
---

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
    ->setView('my.active.view')
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
    ->setSuccessValue(false); // Makes false the 'successful' option
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
    // Note: Parameter `$row` available as of v2.4
    ->setCallback(function(string $value, $row) {
        // Figure out what makes $value true
    }),
```

### Different types of boolean display

By default, the BooleanColumn displays icons.

If you would like the BooleanColumn to display a plain Yes/No, you can set:

```php
BooleanColumn::make('Active')
    ->yesNo()
```

### Toggleable

You may call a defined public function, which should live within your Table Component, to allow "toggling" against your database:

```php
BooleanColumn::make('Active', 'status')
    ->toggleable('changeStatus'),
```

Then your "changeStatus" method may look like (make sure you are selecting the `id` in the query)
```php
    public function changeStatus(int $id)
    {
        $item = $this->model::find($id);
        $item->status = !$item->status;
        $item->save();
    }
```

### Toggleable Confirmation Message

You may define a confirmation message prior to executing your toggleable() method.  The method will only be executed upon confirming.
```php
BooleanColumn::make('Active', 'status')
    ->confirmMessage('Are you sure that you want to change the status?')
    ->toggleable('changeStatus'),
```

Then your "changeStatus" method may look like (make sure you are selecting the `id` in the query)
```php
    public function changeStatus(int $id)
    {
        $item = $this->model::find($id);
        $item->status = !$item->status;
        $item->save();
    }
```


### Additional Methods
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