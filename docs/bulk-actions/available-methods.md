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

## setBulkActionConfirms

When a bulk action is included in the array passed to setBulkActionConfirms, the default wire:confirm pop-up will appear prior to executing the bulk action.  The default message is: "Are you sure?".  This should only be used if you wish to use the default message.

```php
public function configure(): void
{
    $this->setBulkActionConfirms([
        'delete',
        'reset'
    ]);
}
```
## setBulkActionDefaultConfirmationMessage

You may use this method to over-ride the default message.  To override the confirmation message for an individual Bulk Action, see the below setBulkActionConfirmMessage and setBulkActionConfirmMessages.  You may also use the language files to do this.

```php
public function configure(): void
{
    $this->setBulkActionDefaultConfirmationMessage('Are you certain?');
}
```

## setBulkActionConfirmMessage

You may use this method to specify a message other than the default message.

```php
public function configure(): void
{
    $this->setBulkActionConfirmMessage('delete', 'Do you want to delete these items?');
}
```

## setBulkActionConfirmMessages

You may pass an array to this method, to more effectively update the confirmation message for a larger quantity of bulk actions.  This expects an array keyed by the bulk action name, with the value being the message that will be displayed to the user.

```php
public function configure(): void
{
    $this->setBulkActionConfirmMessages([
        'delete' => 'Are you sure you want to delete these items?',
        'purge' => 'Are you sure you want to purge these items?',
        'reassign' => 'This will reassign selected items, are you sure?',
    ]);
}
```

## setBulkActionsThAttributes

You may pass an array to this method, which allows you to pass Custom Attributes into the table header

```php
public function configure(): void
{
    $this->setBulkActionsThAttributes([
        'class' => 'bg-red-500',
        'default' => false
    ]);
}
```

## setBulkActionsThCheckboxAttributes

You may pass an array to this method, which allows you to pass Custom Attributes into the Select All/None checkbox in the Table Header

```php
public function configure(): void
{
    $this->setBulkActionsThCheckboxAttributes([
        'class' => 'bg-blue-500',
        'default' => false
    ]);
}
```

## setBulkActionsTdAttributes

You may pass an array to this method, which allows you to pass Custom Attributes into the td containing the Bulk Actions Checkbox for the row

```php
public function configure(): void
{
    $this->setBulkActionsTdAttributes([
        'class' => 'bg-green-500',
        'default' => true
    ]);
}
```

## setBulkActionsTdCheckboxAttributes

You may pass an array to this method, which allows you to pass Custom Attributes into the Bulk Actions Checkbox for the row

```php
public function configure(): void
{
    $this->setBulkActionsTdCheckboxAttributes([
        'class' => 'bg-green-500',
        'default' => true
    ]);
}
```

## setShouldAlwaysHideBulkActionsDropdownOption

Allows hiding the Bulk Actions button & menu, regardless of whether there are any items selected, or hideBulkActionsWhenEmptyEnabled behaviour

```php
public function configure(): void
{
    $this->setShouldAlwaysHideBulkActionsDropdownOption(true);
}
```


## setShouldAlwaysHideBulkActionsDropdownOptionEnabled

Allows hiding the Bulk Actions button & menu, regardless of whether there are any items selected, or hideBulkActionsWhenEmptyEnabled behaviour

```php
public function configure(): void
{
    $this->setShouldAlwaysHideBulkActionsDropdownOptionEnabled();
}
```


## setShouldAlwaysHideBulkActionsDropdownOptionDisabled

Restores the Bulk Actions to default functionality, so it will respect the hideBulkActionsWhenEmptyEnabled behaviour

```php
public function configure(): void
{
    $this->setShouldAlwaysHideBulkActionsDropdownOptionDisabled();
}
```


## setClearSelectedOnSearch

By default, any selected items for Bulk Actions are cleared upon searching.  You may configure this behaviour here.

```php
public function configure(): void
{
    $this->setClearSelectedOnSearch(true);
}
```


## setClearSelectedOnSearchEnabled

By default, any selected items for Bulk Actions are cleared upon searching.  This enables this behaviour.

```php
public function configure(): void
{
    $this->setClearSelectedOnSearchEnabled();
}
```


## setClearSelectedOnSearchDisabled

By default, any selected items for Bulk Actions are cleared upon searching.  This disables this behaviour, ensuring that selected items are retained after searching.

```php
public function configure(): void
{
    $this->setClearSelectedOnSearchDisabled();
}
```


## setClearSelectedOnFilter

By default, any selected items for Bulk Actions are cleared upon filtering.  You may configure this behaviour here.

```php
public function configure(): void
{
    $this->setClearSelectedOnFilter(true);
}
```


## setClearSelectedOnFilterEnabled

By default, any selected items for Bulk Actions are cleared upon filtering.  This enables this behaviour.

```php
public function configure(): void
{
    $this->setClearSelectedOnFilterEnabled();
}
```


## setClearSelectedOnFilterDisabled

By default, any selected items for Bulk Actions are cleared upon filtering.  This disables this behaviour, ensuring that selected items are retained after filtering.

```php
public function configure(): void
{
    $this->setClearSelectedOnFilterDisabled();
}
```

## setBulkActionsButtonAttributes

You may pass an array to this method, which allows you to pass Custom Attributes into the Bulk Actions Button in the Toolbar

```php
public function configure(): void
{
    $this->setBulkActionsButtonAttributes([
        'class' => 'bg-green-500',
        'default-colors' => true,
        'default-styling' => true,
    ]);
}
```

## setBulkActionsMenuAttributes

You may pass an array to this method, which allows you to pass Custom Attributes into the Bulk Actions Menu

```php
public function configure(): void
{
    $this->setBulkActionsMenuAttributes([
        'class' => 'bg-green-500',
        'default-colors' => true,
        'default-styling' => true,    
    ]);
}
```


## setBulkActionsMenuItemAttributes

You may pass an array to this method, which allows you to pass Custom Attributes into Items on the Bulk Actions Menu

```php
public function configure(): void
{
    $this->setBulkActionsMenuItemAttributes([
        'class' => 'bg-green-500',
        'default-colors' => true,
        'default-styling' => true,    
    ]);
}
```


## setShouldAlwaysHideBulkActionsDropdownOption

Allows hiding the Bulk Actions button & menu, regardless of whether there are any items selected, or hideBulkActionsWhenEmptyEnabled behaviour

```php
public function configure(): void
{
    $this->setShouldAlwaysHideBulkActionsDropdownOption(true);
}
```


## setShouldAlwaysHideBulkActionsDropdownOptionEnabled

Allows hiding the Bulk Actions button & menu, regardless of whether there are any items selected, or hideBulkActionsWhenEmptyEnabled behaviour

```php
public function configure(): void
{
    $this->setShouldAlwaysHideBulkActionsDropdownOptionEnabled();
}
```


## setShouldAlwaysHideBulkActionsDropdownOptionDisabled

Restores the Bulk Actions to default functionality, so it will respect the hideBulkActionsWhenEmptyEnabled behaviour

```php
public function configure(): void
{
    $this->setShouldAlwaysHideBulkActionsDropdownOptionDisabled();
}
```
