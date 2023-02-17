---
title: Available Methods
weight: 4
---

These are the available configuration methods for bulk actions.

---

## setBulkActions

Set the bulk actions array.

```php
public function configure(): void
{
    $this->setBulkActions([
        'exportSelected' => 'Export',
    ]);
}
```

---

## setBulkActionsStatus

**Enabled by default**, enable/disable bulk actions for the component.

```php
public function configure(): void
{
    $this->setBulkActionsStatus(true);
    $this->setBulkActionsStatus(false);
}
```

## setBulkActionsEnabled

Enable bulk actions on the component.

```php
public function configure(): void
{
    // Shorthand for $this->setBulkActionsStatus(true)
    $this->setBulkActionsEnabled();
}
```

## setBulkActionsDisabled

Disable bulk actions on the component.

```php
public function configure(): void
{
    // Shorthand for $this->setBulkActionsStatus(false)
    $this->setBulkActionsDisabled();
}
```

---

## setSelectAllStatus

**Disabled by default**, enable/disable pre-selection of all bulk action check boxes.

```php
public function configure(): void
{
    $this->setSelectAllStatus(true);
    $this->setSelectAllStatus(false);
}
```

## setSelectAllEnabled

Check all bulk action checkboxes.

```php
public function configure(): void
{
    // Shorthand for $this->setSelectAllStatus(true)
    $this->setSelectAllEnabled();
}
```

## setSelectAllDisabled

Deselect the select-all bulk actions checkbox.

```php
public function configure(): void
{
    // Shorthand for $this->setSelectAllStatus(false)
    $this->setSelectAllDisabled();
}
```

---

## setHideBulkActionsWhenEmptyStatus

**Disabled by default**, enable/disable hiding of bulk actions dropdown when empty.

```php
public function configure(): void
{
    $this->setHideBulkActionsWhenEmptyStatus(true);
    $this->setHideBulkActionsWhenEmptyStatus(false);
}
```

## setHideBulkActionsWhenEmptyEnabled

Hide bulk actions dropdown when empty.

```php
public function configure(): void
{
    // Shorthand for $this->setHideBulkActionsWhenEmptyStatus(true)
    $this->setHideBulkActionsWhenEmptyEnabled();
}
```

## setHideBulkActionsWhenEmptyDisabled

Show bulk actions dropdown when empty.

```php
public function configure(): void
{
    // Shorthand for $this->setHideBulkActionsWhenEmptyStatus(false)
    $this->setHideBulkActionsWhenEmptyDisabled();
}
```

## setBulkSelectionsTdAttributes

Customise the attributes for the Column containing the Bulk Actions select boxes.  By default, this replaces the default classes on this Column, if you would like to keep them, set the default flag to true.

```php
public function configure(): void
{
    $this->setBulkSelectionsTdAttributes(['class' => 'p-8', 'default' => true])
}
```

## setBulkSelectionsContainerAttributes

Customise the attributes for the div/container within the Column that contains the Bulk Actions select boxes.  By default, this replaces the default classes on this container, if you would like to keep them, set the default flag to true.

```php
public function configure(): void
{
    $this->setBulkSelectionsContainerAttributes(['class' => 'p-8', 'default' => true])
}
```

## setBulkSelectionsInputAttributes

Customise the attributes for the Bulk Actions select boxes.  By default, this replaces the default classes on this checkbox, if you would like to keep them, set the default flag to true.

```php
public function configure(): void
{
    $this->setBulkSelectionsInputAttributes(['class' => 'p-8', 'default' => true])
}
```
