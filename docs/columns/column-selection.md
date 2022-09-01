---
title: Column Selection
weight: 5
---

Column select is on by default. All columns are selected by default and saved in the users session.

## Excluding from Column Select

If you don't want a column to be able to be turned off from the column select box, you may exclude it:

```php
Column::make('Address', 'address.address')
    ->excludeFromColumnSelect(),
```

## Deselected by default

If you would like a column to be included in the column select but deselected by default, you can specify:

```php
Column::make('Address', 'address.address')
    ->deselected(),
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

### setDataTableFingerprint

In order to idenfify each table and prevent conflicts on column selection, each table is given a unique fingerprint.
This fingerprint is generated using the static::class name of the component. If you are reusing
the same component in different parts of your application, you may need to set your own custom fingerprint.

```php
public function configure(): void
{
    // Default fingerprint is output of protected method dataTableFingerprint()
    // Below will prepend the current route name
    $this->setDataTableFingerprint(route()->getName() . '-' . $this->dataTableFingerprint());
}
```
