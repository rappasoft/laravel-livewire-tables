---
title: Filter Pills
weight: 7
---

When a Filter is set/applied, it will be displayed at the top of your Table in a "filter pills" section, contained within the Tools area

There are both Component/Table wide, and Filter specific configurations available:

---

## Component Methods

These methods apply across your whole table

### setFilterPillsStatus

**Enabled by default**, show/hide the filter pills.

```php
public function configure(): void
{
    $this->setFilterPillsStatus(true);
    $this->setFilterPillsStatus(false);
}
```

### setFilterPillsEnabled

Show the filter pills for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFilterPillsStatus(true)
    $this->setFilterPillsEnabled();
}
```

### setFilterPillsDisabled

Hide the filter pills for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFilterPillsStatus(false)
    $this->setFilterPillsDisabled();
}
```

---

### setFilterPillsItemAttributes
Allows for customisation of the appearance of the "Filter Pills Item"

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

#### default-colors
Setting to false will disable the default colors for the Filter Pills Item, the default colors are:

Bootstrap: None

Tailwind: `bg-indigo-100 text-indigo-800 dark:bg-indigo-200 dark:text-indigo-900`

#### default-styling
Setting to false will disable the default styling for the Filter Pills Item, the default styling is:

Bootstrap 4: `badge badge-pill badge-info d-inline-flex align-items-center`

Bootstrap 5: `badge rounded-pill bg-info d-inline-flex align-items-center`

Tailwind: `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 capitalize`

```php
public function configure(): void
{
  $this->setFilterPillsItemAttributes([
    'class' => 'bg-rose-300 text-rose-800 dark:bg-indigo-200 dark:text-indigo-900', // Add these classes to the filter pills item
    'default-colors' => false, // Do not output the default colors
    'default-styling' => true // Output the default styling
  ]);
}
```

---

### setFilterPillsResetFilterButtonAttributes
Allows for customisation of the appearance of the "Filter Pills Reset Filter Button"

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

#### default-colors
Setting to false will disable the default colors for the Filter Pills Reset Filter Button, the default colors are:

Bootstrap: None

Tailwind: `text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:bg-indigo-500 focus:text-white`

#### default-styling
Setting to false will disable the default styling for the Filter Pills Reset Filter Button, the default styling is:

Bootstrap: `text-white ml-2`

Tailwind: `flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center focus:outline-none`

```php
public function configure(): void
{
  $this->setFilterPillsResetFilterButtonAttributes([
    'class' => 'text-rose-400 hover:bg-rose-200 hover:text-rose-500 focus:bg-rose-500', // Add these classes to the filter pills reset filter button
    'default-colors' => false, // Do not output the default colors
    'default-styling' => true // Output the default styling
  ]);
}
```

---

### setFilterPillsResetAllButtonAttributes
Allows for customisation of the appearance of the "Filter Pills Reset All Button"

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

#### default-colors
Setting to false will disable the default colors for the Filter Pills Reset All Button, the default colors are:

Bootstrap: None

Tailwind: `bg-gray-100 text-gray-800 dark:bg-gray-200 dark:text-gray-900`

#### default-styling
Setting to false will disable the default styling for the Filter Pills Reset All Button, the default styling is:

Bootstrap 4: `badge badge-pill badge-light`

Bootstrap 5: `badge rounded-pill bg-light text-dark text-decoration-none`

Tailwind: `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium`

```php
public function configure(): void
{
  $this->setFilterPillsResetAllButtonAttributes([
    'class' => 'bg-rose-100 text-rose-800 dark:bg-gray-200 dark:text-gray-900', // Add these classes to the filter pills reset all button
    'default-colors' => false, // Do not output the default colors
    'default-styling' => true // Output the default styling
  ]);
}
```

---

## Filter Methods

These methods apply to individual filters

### setFilterPillTitle

By default, the filter pill title is the filter name, but you can make it whatever you want:

```php
SelectFilter::make('Active')
    ->setFilterPillTitle('User Status')
```

### setFilterPillValues

If you have numeric, or generated keys as your filter option values, they probably don't look too nice in the filter pill. You can set the values to be displayed in the filter pill:

```php
SelectFilter::make('Active')
    ->setFilterPillTitle('User Status')
    ->setFilterPillValues([
        '1' => 'Active',
        '0' => 'Inactive',
    ])
    ->options([
        '' => 'All',
        '1' => 'Yes',
        '0' => 'No',
    ])
```

Now instead of `Active: Yes` it will say `User Status: Active`


### hiddenFromPills

Hide the filter from the filter pills when applied.

```php
SelectFilter::make('Active')
    ->hiddenFromPills()
```

---

### setFilterPillBlade

Set a blade file for use in displaying the filter values in the pills area.  You can use this in conjunction with setFilterPillValues() to prettify your applied filter values display.  You will receive two properties ($filter) containing the filter instance, and ($value) containing the filter value.

```php
SelectFilter::make('Active')
    ->setFilterPillBlade('path.to.blade')
```

Example blade:
```php
@aware(['tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5'])
@props(['filterPillTitle', 'filterPillValue', 'filterSelectName', 'separator'])
<x-livewire-tables::tools.filter-pills.wrapper :$filterSelectName>
    {{ $filterPillTitle }}:

    @if(is_array($filterPillValue))
        @foreach($filterPillValue as $filterPillArrayValue)
            {{ $filterPillArrayValue }}{!! !$loop->last ? $separator : '' !!}
        @endforeach
    @else
        {{ $filterPillValue }}
    @endif

</x-livewire-tables::tools.filter-pills.wrapper>

```

### setPillAttributes

This may be used in conjunction with, or instead of the setFilterPillsItemAttributes method, and applies to an individual Filter's pills.  

Note that if used, this will **replace** any matching array keys defined in the setFilterPillsItemAttributes method. 

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently

#### default-colors
Setting to false will disable the default colors for this Filter's Pills Item, the default colors are:

Bootstrap: None

Tailwind: `bg-indigo-100 text-indigo-800 dark:bg-indigo-200 dark:text-indigo-900`

#### default-styling
Setting to false will disable the default styling for this Filter's Pills Item, the default styling is:

Bootstrap 4: `badge badge-pill badge-info d-inline-flex align-items-center`

Bootstrap 5: `badge rounded-pill bg-info d-inline-flex align-items-center`

Tailwind: `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 capitalize`

```php
SelectFilter::make('Active')
    ->options([
        '' => 'All',
        '1' => 'Yes',
        '0' => 'No',
    ])
    ->setFilterPillTitle('User Status')
    ->setFilterPillValues([
        '1' => 'Active',
        '0' => 'Inactive',
    ])
    ->setPillAttributes([
        'class' => 'bg-rose-300 text-rose-800 dark:bg-indigo-200 dark:text-indigo-900',
        'default-colors' => false, // Replace the default colors classes
        'default-styling' => true // Use the default styling classes
    ])
```