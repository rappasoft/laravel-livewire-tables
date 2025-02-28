---
title: Available Filter Methods
weight: 6
---

The following methods are available on the filter object.  These are "filter-specific" methods.

Ensure you check out:
- [Available Component Methods](./available-component-methods) documentation for Table Wide configuration
- [Filter Pills](./filter-pills) documentation for help with configuring the pills for a filter


## hiddenFromMenus

Hide the filter from both the filter popover and the filter slide down.

```php
SelectFilter::make('Active')
    ->hiddenFromMenus()
```

## hiddenFromPills

Hide the filter from the filter pills when applied.

```php
SelectFilter::make('Active')
    ->hiddenFromPills()
```

## hiddenFromFilterCount

Hide the filter from the filter count when applied.

```php
SelectFilter::make('Active')
    ->hiddenFromFilterCount()
```

## hiddenFromAll

Hide the filter from the menus, pills, and count.

```php
SelectFilter::make('Active')
    ->hiddenFromAll()
```

## notResetByClearButton

By default the `clear` button will reset all filters to their defaults. You can prevent this on a specific filter by using this method.

```php
SelectFilter::make('Active')
    ->notResetByClearButton()
```

## setCustomView
Use a fully custom view for a filter.  This will utilise solely your view when rendering this filter.  Note that the following methods will no longer apply to a filter using this:
- setCustomFilterLabel
- setFilterLabelAttributes

```php
TextFilter::make('Name')
    ->setCustomView('text-custom-view'),
```

## Config

If the filter takes any config options, you can set them with the `config` method:

```php
 DateFilter::make('Date')
    ->config([
        'min' => '2020-01-01',
        'max' => '2021-12-31',
    ])
```

## Customising Wireable Behaviour

For the following Filters, you may customise how the input is wire:model into the Table Component:

- DateFilter (Defaults to Live)
- DateTimeFilter (Defaults to Live)
- MultiSelectDropdownFilter (Defaults to live.debounce.250ms)
- MultiSelectFilter (Defaults to live.debounce.250ms)
- NumberFilter (Defaults to Blur)
- SelectFilter (Defaults to Live)
- TextFilter (Defaults to Blur)

You may override this using the following methods, on any of the above Filter types:

### setWireBlur()
Forces the filter to use a wire:model.blur approach
```php
    TextFilter::make('Name')
    ->config([
        'placeholder' => 'Search Name',
        'maxlength' => '25',
    ])
    ->setWireBlur()
```

### setWireDefer()
Forces the filter to use a wire:model approach
```php
    TextFilter::make('Name')
    ->config([
        'placeholder' => 'Search Name',
        'maxlength' => '25',
    ])
    ->setWireDefer()
```

### setWireLive()
Forces the fitler to use a wire:model.live approach
```php
    TextFilter::make('Name')
    ->config([
        'placeholder' => 'Search Name',
        'maxlength' => '25',
    ])
    ->setWireLive()
```

### setWireDebounce(int $debounceDelay)
Allows you to pass a string to use a wire:model.live.debounce.Xms approach
```php
    TextFilter::make('Name')
    ->config([
        'placeholder' => 'Search Name',
        'maxlength' => '25',
    ])
    ->setWireDebounce(50)
```

--- 

## Styling

These methods allow you to over-ride default styling for individual Filters

---

### setFilterSlidedownRow

This method applies only when using the Slide Down approach to filter display.
By default the filters will be displayed in the order that they are listed in the filters() method.  This method allows you to specify the row that the filter will be listed.  When multiple filters are placed on the same row, and a mobile device is used, then the first filter listed will "win" that row.
You may use either a string or an integer to pass to this method, and it can be used in conjunction with setFilterSlidedownColspan

```php
SelectFilter::make('Active')
    ->setFilterSlidedownRow(1)
```

### setFilterSlidedownColspan

This method applies only when using the Slide Down approach to filter display.
By default each filter will take up one column, with the number of columns determined by the size of the screen, this ranges from 1 on a mobile device, to a maximum of 5 on a large display.  This method allows you to specify the number of columns that the filter should span.  It will span the number of columns specified, up to the number of columns available (depending on screen size).
You may use either a string or an integer to pass to this method, and it can be used in conjunction with setFilterSlidedownRow

```php
DateFilter::make('Date')
    ->config([
        'min' => '2020-01-01',
        'max' => '2021-12-31',
    ])
    ->setFilterSlidedownColspan('2')
```

---

### setCustomFilterLabel

Set a custom blade file for the filter's label.  This will be used in both the Pop-Over and SlideDown filter displays, you should therefore ensure that you cater for the different filter layouts.

```php
SelectFilter::make('Active')
    ->setCustomFilterLabel('path.to.blade')
```

You will receive several properties to your blade, explained here:
- $filter (the filter instance)
- $filterLayout ('slide-down' or 'popover')
- $tableName (the table name)
- $isTailwind (bool - is theme Tailwind)
- $isBootstrap (bool - is theme Bootstrap 4 or Bootstrap 5)
- $isBootstrap4 (bool - is theme Bootstrap 4)
- $isBootstrap5 (bool - is theme Bootstrap 5)
- $customLabelAttributes (array -> any customLabel attributes set using setFilterLabelAttributes())

Example label blade:
```php
@aware([ 'tableName'])
@props(['filter', 'filterLayout' => 'popover', 'tableName' => 'table', 'isTailwind' => false, 'isBootstrap' => false, 'isBootstrap4' => false, 'isBootstrap5' => false, 'for' => null])

<label for="{{ $for ?? $tableName.'-filter-'.$filter->getKey() }}" {{
        $attributes->merge($customLabelAttributes)->merge($filterLabelAttributes)
            ->class([
                'block text-sm font-medium leading-5' => $isTailwind && ($filterLabelAttributes['default-styling'] ?? ($filterLabelAttributes['default'] ?? true)),
                'text-gray-700 dark:text-white' => $isTailwind && ($filterLabelAttributes['default-colors'] ?? ($filterLabelAttributes['default'] ?? true)),
                'd-block' => $isBootstrap && $filterLayout === 'slide-down' && ($filterLabelAttributes['default-styling'] ?? ($filterLabelAttributes['default'] ?? true)),
                'mb-2' => $isBootstrap && $filterLayout === 'popover' && ($filterLabelAttributes['default-styling'] ?? ($filterLabelAttributes['default'] ?? true)),
            ])
            ->except(['default', 'default-colors', 'default-styling'])
    }}
>
    {{ $filter->getName() }}
</label>
```

### setFilterLabelAttributes

#### Old Method (Still Supported)
Set custom attributes for a Filter Label.  At present it is recommended to only use this for "class" and "style" attributes to avoid conflicts.

By default, this replaces the default classes on the Filter Label wrapper, if you would like to keep them, set the default flag to true.

```php
TextFilter::make('Name')
    ->setFilterLabelAttributes(
        [
            'class' => 'text-xl', 
            'default' => true,
        ]
    ),
```

#### New Method (Recommended)
Set custom attributes for a Filter Label.  At present it is recommended to only use this for "class" and "style" attributes to avoid conflicts.

By default, this replaces the default classes on the Filter Label wrapper, if you would like to keep them, set the default flag to true.

```php
TextFilter::make('Name')
    ->setLabelAttributes(
        [
            'class' => 'text-xl', 
            'default' => true,
        ]
    ),
```

---

### setInputAttributes
Allows for customising the attributes that will apply to the input field for the filter.

By default, this replaces the default classes on the Filter Input, if you would like to keep them, set the default-styling and/or default-colors flags to true.

#### TextFilter Example
The following would:
- Set a maxlength of 75
- Set a placeholder of "Enter a Name"
- Replace the default colors
- Retain the default styling (e.g. rounding/shadow)

```php
public function filters(): array
{
    return [
        TextFilter::make('Name')
        ->setInputAttributes([
            'maxlength' => '75',
            'placeholder' => 'Enter a Name',
            'class' => 'text-white bg-red-500 dark:bg-red-500',
            'default-colors' => false,
            'default-styling' => true,
        ]),
    ];
}
```

#### NumberFilter Example
The following would:
- Set a min of 5
- Set a max of 20
- Set steps to be 0.5
- Keep the default colors & styling

```php
public function filters(): array
{
    return [
        NumberFilter::make('Age')
        ->setInputAttributes([
            'min' => '5',
            'max' => '20',
            'step' => '0.5',
            'default-colors' => true,
            'default-styling' => true,
        ]),
    ];
}
```