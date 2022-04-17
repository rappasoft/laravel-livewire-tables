---
title: Debugging
weight: 4
---

## Configuration

### setDebugStatus

**Disabled by default**, enable/disable debugging for the component.

```php
public function configure(): void
{
    $this->setDebugStatus(true);
    $this->setDebugStatus(false);
}
```

### setDebugEnabled

Enable debugging for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setDebugStatus(true)
    $this->setDebugEnabled();
}
```

### setDebugDisabled

Disable debugging for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setDebugStatus(false)
    $this->setDebugDisabled();
}
```
