---
title: Available Methods
weight: 4
---

## Component Methods

These are the available filters configuration methods on the component.

---

Filters are **enabled by default** but will only show up if you have at least one defined.

### setFiltersStatus

Enable/disable filters for the whole component.

```php
public function configure(): void
{
    $this->setFiltersStatus(true);
    $this->setFiltersStatus(false);
}
```

### setFiltersEnabled

Enable filters for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFiltersStatus(true)
    $this->setFiltersEnabled();
}
```

### setFiltersDisabled

Disable filters for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFiltersStatus(false)
    $this->setFiltersDisabled();
}
```

---

### setFiltersVisibilityStatus

**Enabled by default**, show/hide the filters dropdown.

```php
public function configure(): void
{
    $this->setFiltersVisibilityStatus(true);
    $this->setFiltersVisibilityStatus(false);
}
```

### setFiltersVisibilityEnabled

Show the filters dropdown for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFiltersVisibilityStatus(true)
    $this->setFiltersVisibilityEnabled();
}
```

### setFiltersVisibilityDisabled

Hide the filters dropdown for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFiltersVisibilityStatus(false)
    $this->setFiltersVisibilityDisabled();
}
```

---

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

### setFilterLayout

Set the filter layout for the component.

```php
public function configure(): void
{
    $this->setFilterLayout('slide-down');
}
```

### setFilterLayoutPopover

Set the filter layout to popover.

```php
public function configure(): void
{
    $this->setFilterLayoutPopover();
}
```

Set the filter layout to slide down.

### setFilterLayoutSlideDown

```php
public function configure(): void
{
    $this->setFilterLayoutSlideDown();
}
```

----

## Filter Methods

The following methods are available on the filter object.

----

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

### Config

If the filter takes any config options, you can set them with the `config` method:

```php
 DateFilter::make('Date')
    ->config([
        'min' => '2020-01-01',
        'max' => '2021-12-31',
    ])
```