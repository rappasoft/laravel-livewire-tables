---
title: Column Selection
weight: 5
---

Column select is on by default. All columns are selected by default and saved in the users session.

## Excluding from Column Select

If you don't want a column to be able to be turned off from the column select box, you may exclude it:

```php
Column::make('Address', 'address.address')
    ->excludeFromColumnSelect()
```

## Available Methods

### setColumnSelectStatus

**Enabled by default**, enable/disable column select for the component.

```php
public function configure(): void
{
    $this->setColumnSelectStatus(true);
    $this->setColumnSelectStatus(false);
}
```

### setColumnSelectEnabled

Enable column select on the component.

```php
public function configure(): void
{
    // Shorthand for $this->setColumnSelectStatus(true)
    $this->setColumnSelectEnabled();
}
```

### setColumnSelectDisabled

Disable column select on the component.

```php
public function configure(): void
{
    // Shorthand for $this->setColumnSelectStatus(false)
    $this->setColumnSelectDisabled();
}
```

### setRememberColumnSelectionStatus

**Enabled by default**, whether or not to remember the users column select choices.

```php
public function configure(): void
{
    $this->setRememberColumnSelectionStatus(true);
    $this->setRememberColumnSelectionStatus(false);
}
```

### setRememberColumnSelectionEnabled

Remember the users column select choices.

```php
public function configure(): void
{
    // Shorthand for $this->setRememberColumnSelectionStatus(true)
    $this->setRememberColumnSelectionEnabled();
}
```

### setRememberColumnSelectionDisabled

Forget the users column select choices.

```php
public function configure(): void
{
    // Shorthand for $this->setRememberColumnSelectionStatus(false)
    $this->setRememberColumnSelectionDisabled();
}
```