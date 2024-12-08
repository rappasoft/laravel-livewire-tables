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
