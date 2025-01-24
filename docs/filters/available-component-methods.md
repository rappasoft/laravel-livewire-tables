---
title: Available Component Methods
weight: 5
---

These are the available filters configuration methods on the component.  These are "table-wide" methods.

---

Filters are **enabled by default** but will only show up if you have at least one defined.

## setFiltersStatus

Enable/disable filters for the whole component.

```php
public function configure(): void
{
    $this->setFiltersStatus(true);
    $this->setFiltersStatus(false);
}
```

## setFiltersEnabled

Enable filters for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFiltersStatus(true)
    $this->setFiltersEnabled();
}
```

## setFiltersDisabled

Disable filters for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFiltersStatus(false)
    $this->setFiltersDisabled();
}
```

---

## setFiltersVisibilityStatus

**Enabled by default**, show/hide the filters dropdown.

```php
public function configure(): void
{
    $this->setFiltersVisibilityStatus(true);
    $this->setFiltersVisibilityStatus(false);
}
```

## setFiltersVisibilityEnabled

Show the filters dropdown for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFiltersVisibilityStatus(true)
    $this->setFiltersVisibilityEnabled();
}
```

## setFiltersVisibilityDisabled

Hide the filters dropdown for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFiltersVisibilityStatus(false)
    $this->setFiltersVisibilityDisabled();
}
```

## setFilterButtonAttributes
Allows for customisation of the appearance of the "Filter Button"

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

#### default-colors
Setting to false will disable the default colors for the Filter Button, the default colors are:

Bootstrap: None

Tailwind: `border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600`

#### default-styling
Setting to false will disable the default styling for the Filter Button, the default styling is:

Bootstrap: `btn dropdown-toggle d-block w-100 d-md-inline`

Tailwind: `inline-flex justify-center w-full rounded-md border shadow-sm px-4 py-2 text-sm font-medium focus:ring focus:ring-opacity-50`

```php
public function configure(): void
{
  $this->setFilterButtonAttributes([
    'class' => 'border-rose-300 bg-white text-rose-700 hover:bg-rose-50 focus:border-stone-300 focus:ring-stone-200', // Add these classes to the filter button
    'default-colors' => false, // Do not output the default colors
    'default-styling' => true // Output the default styling
  ]);
}
```

## setFilterButtonBadgeAttributes
Allows for customisation of the appearance of the "Filter Button Badge"

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

#### default-colors
Setting to false will disable the default colors for the Filter Button Badge, the default colors are:

Bootstrap: None

Tailwind: `bg-indigo-100 text-indigo-800 dark:bg-indigo-200 dark:text-indigo-900`

#### default-styling
Setting to false will disable the default styling for the Filter Button Badge, the default styling is:

Bootstrap: `badge badge-info`

Tailwind: `ml-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 capitalize`

```php

public function configure(): void
{
  $this->setFilterButtonBadgeAttributes([
    'class' => 'bg-rose-100 text-rose-800', // Add these classes to the filter button badge
    'default-colors' => false, // Do not output the default colors
    'default-styling' => true // Output the default styling
  ]);
}
```

---

## setFilterPillsStatus

**Enabled by default**, show/hide the filter pills.

```php
public function configure(): void
{
    $this->setFilterPillsStatus(true);
    $this->setFilterPillsStatus(false);
}
```

## setFilterPillsEnabled

Show the filter pills for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFilterPillsStatus(true)
    $this->setFilterPillsEnabled();
}
```

## setFilterPillsDisabled

Hide the filter pills for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFilterPillsStatus(false)
    $this->setFilterPillsDisabled();
}
```

## setFilterPillsItemAttributes
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

## setFilterPillsResetFilterButtonAttributes
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

## setFilterPillsResetAllButtonAttributes
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

## setFilterLayout

Set the filter layout for the component.

```php
public function configure(): void
{
    $this->setFilterLayout('slide-down');
}
```

## setFilterLayoutPopover

Set the filter layout to popover.

```php
public function configure(): void
{
    $this->setFilterLayoutPopover();
}
```

Set the filter layout to slide down.

## setFilterLayoutSlideDown

```php
public function configure(): void
{
    $this->setFilterLayoutSlideDown();
}
```

## setFilterSlideDownDefaultStatusEnabled

Set the filter slide down to visible by default

```php
public function configure(): void
{
    // Shorthand for $this->setFilterSlideDownDefaultStatus(true)
    $this->setFilterSlideDownDefaultStatusEnabled();
}
```

## setFilterSlideDownDefaultStatusDisabled

Set the filter slide down to collapsed by default

```php
public function configure(): void
{
    // Shorthand for $this->setFilterSlideDownDefaultStatus(false)
    $this->setFilterSlideDownDefaultStatusDisabled();
}
```

## storeFiltersInSessionEnabled

Optional behaviour - stores filter values in the session (specific to table - based on the table name)

### Exercise Caution 
If re-using the same Livewire Table Component multiple times in your site, with the same table name, this may cause clashes in filter values

```php
public function configure(): void
{
    $this->storeFiltersInSessionEnabled();
}
```
## storeFiltersInSessionDisabled

Default behaviour - does not store filters in the session

```php
public function configure(): void
{
    $this->storeFiltersInSessionDisabled();
}
```

## setFilterPopoverAttributes

Allows for the customisation of the appearance of the Filter Popover Menu.

Note the addition of a "default-width" boolean, allowing you to customise the width more smoothly without impacting other applied classes.

You may also replace default colors by setting "default-colors" to false, or default styling by setting "default-styling" to false, and specifying replacement classes in the "class" property.

You can also replace the default transition behaviours (Tailwind) by specifying replacement attributes in the array.

```php
public function configure(): void
{
    $this->setFilterPopoverAttributes(
        [
        'class' => 'w-96',
        'default-width' => false,
        'default-colors' => true,
        'default-styling' => true, 
        'x-transition:enter' => 'transition ease-out duration-100',
        ]
    );
}
```

## setFilterSlidedownWrapperAttributes

Allows for the customisation of the appearance of the Filter Slidedown Wrapper.

You may also replace default colors by setting "default-colors" to false, or default styling by setting "default-styling" to false, and specifying replacement classes in the "class" property.

You can also replace the default transition behaviours (Tailwind) by specifying replacement attributes in the array, for example to extend the duration of the transition effect from the default duration-100 to duration-1000:

```php
public function configure(): void
{
    $this->setFilterSlidedownWrapperAttributes([
        'x-transition:enter' => 'transition ease-out duration-1000',
        'class' => 'text-black',
        'default-colors' => true,
        'default-styling' => true, 
    ]);
}
```

## setFilterSlidedownRowAttributes

Allows for the customisation of the appearance of the Filter Slidedown Row.  Note that this uses a callback, which receives the "rowIndex" of the Slidedown Row

You may replace default colors by setting "default-colors" to false, or default styling by setting "default-styling" to false, and specifying replacement classes in the "class" property.

```php
public function configure(): void
{
    $this->setFilterSlidedownRowAttributes(fn($rowIndex) => $rowIndex % 2 === 0 ? 
        [
            'class' => 'bg-red-500',
            'default-colors' => true,
            'default-styling' => true, 
        ] :  [
            'class' => 'bg-blue-500',
            'default-colors' => true,
            'default-styling' => true, 
        ] 
    );
}
```
