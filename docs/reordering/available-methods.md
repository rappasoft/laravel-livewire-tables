---
title: Available Methods
weight: 4
---

These are the available configuration methods for reordering.

---

## setReorderStatus

Disabled by default, enable/disable reordering for the component.

```php
public function configure(): void
{
    $this->setReorderStatus(true);
    $this->setReorderStatus(false);
}
```

## setReorderEnabled

Enable reordering on the component.

```php
public function configure(): void
{
    // Shorthand for $this->setReorderStatus(true);
    $this->setReorderEnabled();
}
```

## setReorderDisabled

Disable reordering on the component.

```php
public function configure(): void
{
    // Shorthand for $this->setReorderStatus(false);
    $this->setReorderDisabled();
}
```

---

## setCurrentlyReorderingStatus

Disabled by default, start/stop reordering for the component.

```php
public function configure(): void
{
    $this->setCurrentlyReorderingStatus(true);
    $this->setCurrentlyReorderingStatus(false);
}
```

## setCurrentlyReorderingEnabled

Start reordering for the component. (Handled by the reorder button, but if you wanted to start reordering without the button, you can call this method.)

```php
public function configure(): void
{
    // Shorthand for $this->setCurrentlyReorderingStatus(true);
    $this->setCurrentlyReorderingEnabled();
}
```

## setCurrentlyReorderingDisabled

Stop reordering for the component. (Handled by the reorder button, but if you wanted to stop reordering without the button, you can call this method.)

```php
public function configure(): void
{
    // Shorthand for $this->setCurrentlyReorderingStatus(false);
    $this->setCurrentlyReorderingDisabled();
}
```

---

## setHideReorderColumnUnlessReorderingStatus

Disabled by default. If your reorder column is part of your table definition, then show/hide it.

```php
public function configure(): void
{
    $this->setHideReorderColumnUnlessReorderingStatus(true);
    $this->setHideReorderColumnUnlessReorderingStatus(false);
}
```

## setHideReorderColumnUnlessReorderingEnabled

Hide the reorder column from the table unless reordering.

```php
public function configure(): void
{
    // Shorthand for $this->setHideReorderColumnUnlessReorderingStatus(true);
    $this->setHideReorderColumnUnlessReorderingEnabled();
}
```

## setHideReorderColumnUnlessReorderingDisabled

Don't hide the reorder column from the table.

```php
public function configure(): void
{
    // Shorthand for $this->setHideReorderColumnUnlessReorderingStatus(false);
    $this->setHideReorderColumnUnlessReorderingDisabled();
}
```

---

## setReorderMethod

Set the method that will be called when a row is moved. (Default is `reorder`.)

```php
public function configure(): void
{
    $this->setReorderMethod('changeOrder');
}
```

## setDefaultReorderSort

Set the default sort the table will use when reordering. (Default is `sort` and `asc`.)

```php
public function configure(): void
{
    $this->setDefaultReorderSort('order', 'desc');
}
```
