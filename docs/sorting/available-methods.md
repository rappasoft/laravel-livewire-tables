---
title: Available Methods
weight: 1
---

These are the available sorting configuration methods on the component.

---

Sorting as a whole is **enabled by default**, but if you ever needed to toggle it you can use the following methods:

## setSortingStatus

Enable/disable sorting for the whole component.

```php
public function configure(): void
{
    $this->setSortingStatus(true);
    $this->setSortingStatus(false);
}
```

## setSortingEnabled

Enable sorting for the whole component.

```php
public function configure(): void
{
    // Shorthand for $this->setSortingStatus(true)
    $this->setSortingEnabled();
}
```

## setSortingDisabled

Disable sorting for the whole component.

```php
public function configure(): void
{
    // Shorthand for $this->setSortingStatus(false)
    $this->setSortingDisabled();
}
```

---

Single sorting is **enabled by default**, but if you ever needed to toggle it you can use the follow methods:

## setSingleSortingStatus

Enable/disable single sorting for the whole component.

```php
public function configure(): void
{
    $this->setSingleSortingStatus(true);
    $this->setSingleSortingStatus(false);
}
```

## setSingleSortingEnabled

Enable single sorting for the whole component.

```php
public function configure(): void
{
    // Shorthand for $this->setSingleSortingStatus(true)
    $this->setSingleSortingEnabled();
}
```

## setSingleSortingDisabled

Disable single sorting for the whole component.

```php
public function configure(): void
{
    // Shorthand for $this->setSingleSortingStatus(false)
    $this->setSingleSortingDisabled();
}
```

---

There is **no default sort by default**, but if you wanted to add one:

## setDefaultSort

Set the default sorting column and direction.

```php
public function configure(): void
{
    $this->setDefaultSort('name', 'desc');
}
```

If you had the need to programmatically remove the default sort:

## removeDefaultSort

Remove the default sort.

```php
public function configure(): void
{
    $this->removeDefaultSort();
}
```

---

Sorting pills are **enabled by default**, but if you ever needed to toggle it you can use the following methods:

## setSortingPillsStatus

Enable/disable sorting pills for the whole component.

```php
public function configure(): void
{
    $this->setSortingPillsStatus(true);
    $this->setSortingPillsStatus(false);
}
```

## setSortingPillsEnabled

Enable sorting pills for the whole component.

```php
public function configure(): void
{
    // Shorthand for $this->setSortingPillsStatus(true)
    $this->setSortingPillsEnabled();
}
```

## setSortingPillsDisabled

Disable sorting pills for the whole component.

```php
public function configure(): void
{
    // Shorthand for $this->setSortingPillsStatus(false)
    $this->setSortingPillsDisabled();
}
```

## setSortingPillsItemAttributes
Allows for customisation of the appearance of the "Sorting Pills Item"

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

#### default-colors
Setting to false will disable the default colors for the Sorting Pills Item, the default colors are:

Bootstrap: None

Tailwind: `bg-indigo-100 text-indigo-800 dark:bg-indigo-200 dark:text-indigo-900`

#### default-styling
Setting to false will disable the default styling for the Sorting Pills Item, the default styling is:

Bootstrap 4: `badge badge-pill badge-info d-inline-flex align-items-center`

Bootstrap 5: `badge rounded-pill bg-info d-inline-flex align-items-center`

Tailwind: `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 capitalize`

```php
public function configure(): void
{
  $this->setSortingPillsItemAttributes([
    'class' => 'bg-rose-300 text-rose-800 dark:bg-indigo-200 dark:text-indigo-900', // Add these classes to the sorting pills item
    'default-colors' => false, // Do not output the default colors
    'default-styling' => true // Output the default styling
  ]);
}
```

## setSortingPillsClearSortButtonAttributes
Allows for customisation of the appearance of the "Sorting Pills Clear Sort Button"

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

#### default-colors
Setting to false will disable the default colors for the Sorting Pills Clear Sort Button, the default colors are:

Bootstrap: None

Tailwind: `text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:bg-indigo-500 focus:text-white`

#### default-styling
Setting to false will disable the default styling for the Sorting Pills Clear Sort Button, the default styling is:

Bootstrap 4: `text-white ml-2`

Bootstrap 5: `text-white ms-2`

Tailwind: `flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center focus:outline-none`

```php
public function configure(): void
{
  $this->setSortingPillsClearSortButtonAttributes([
    'class' => 'text-rose-400 hover:bg-rose-200 hover:text-rose-500 focus:bg-rose-500', // Add these classes to the sorting pills clear sort button
    'default-colors' => false, // Do not output the default colors
    'default-styling' => true // Output the default styling
  ]);
}
```

## setSortingPillsClearAllButtonAttributes
Allows for customisation of the appearance of the "Sorting Pills Clear All Button"

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

#### default-colors
Setting to false will disable the default colors for the Sorting Pills Clear All Button, the default colors are:

Bootstrap: None

Tailwind: `bg-gray-100 text-gray-800 dark:bg-gray-200 dark:text-gray-900`

#### default-styling
Setting to false will disable the default styling for the Sorting Pills Clear All Button, the default styling is:

Bootstrap 4: `badge badge-pill badge-light`

Bootstrap 5: `badge rounded-pill bg-light text-dark text-decoration-none`

Tailwind: `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium`

```php
public function configure(): void
{
  $this->setSortingPillsClearAllButtonAttributes([
    'class' => 'bg-rose-100 text-rose-800 dark:bg-gray-200 dark:text-gray-900', // Add these classes to the sorting pills clear all button
    'default-colors' => false, // Do not output the default colors
    'default-styling' => true // Output the default styling
  ]);
}
```

---

## setDefaultSortingLabels

If you would like to set the default sorting labels for the sorting pills you may override them:

By default, they are A-Z for ascending and Z-A for descending.

```php
public function configure(): void
{
    $this->setDefaultSortingLabels('Asc', 'Desc');
}
```
