---
title: Available Methods
weight: 1
---

These are the available configuration methods for the secondary header.

---

## setSecondaryHeaderStatus

Enabled by default, enable/disable the secondary header for the component.

```php
public function configure(): void
{
    $this->setSecondaryHeaderStatus(true);
    $this->setSecondaryHeaderStatus(false);
}
```

## setSecondaryHeaderEnabled

Enable the secondary header on the component.

```php
public function configure(): void
{
    // Shorthand for $this->setSecondaryHeaderStatus(true);
    $this->setSecondaryHeaderEnabled();
}
```

## setSecondaryHeaderDisabled

Disable the secondary header on the component.

```php
public function configure(): void
{
    // Shorthand for $this->setSecondaryHeaderStatus(false);
    $this->setSecondaryHeaderDisabled();
}
```


---

See also:
[secondary header styling](./styling).
[secondary header column configuration](../columns/secondary-header).