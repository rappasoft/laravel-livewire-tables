---
title: Styling
weight: 5
---

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
