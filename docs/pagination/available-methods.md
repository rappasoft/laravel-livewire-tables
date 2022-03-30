---
title: Available Methods
weight: 1
---

These are the available configuration methods for pagination.

---

## setPageName

Set the page name for the component's pagination, defaults to `page`.

```php
public function configure(): void
{
    $this->setPageName('users');
}
```

---

## setPaginationStatus

**Enabled by default**, enable/disable pagination for the component.

```php
public function configure(): void
{
    $this->setPaginationStatus(true);
    $this->setPaginationStatus(false);
}
```

## setPaginationEnabled

Enable pagination for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setPaginationStatus(true);
    $this->setPaginationEnabled();
}
```

## setPaginationDisabled

Disable pagination for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setPaginationStatus(false);
    $this->setPaginationDisabled();
}
```

---

## setPaginationVisibilityStatus

**Enabled by default**, enable/disable pagination visibility.

```php
public function configure(): void
{
    $this->setPaginationVisibilityStatus(true);
    $this->setPaginationVisibilityStatus(false);
}
```

## setPaginationVisibilityEnabled

Enable pagination visibility.

```php
public function configure(): void
{
    // Shorthand for $this->setPaginationVisibilityStatus(true);
    $this->setPaginationVisibilityEnabled();
}
```

## setPaginationVisibilityDisabled

Disable pagination visibility.

```php
public function configure(): void
{
    // Shorthand for $this->setPaginationVisibilityStatus(false);
    $this->setPaginationVisibilityDisabled();
}
```

---

## setPerPageVisibilityStatus

**Enabled by default**, enable/disable per page visibility.

```php
public function configure(): void
{
    $this->setPerPageVisibilityStatus(true);
    $this->setPerPageVisibilityStatus(false);
}
```

## setPerPageVisibilityEnabled

Enable per page visibility.

```php
public function configure(): void
{
    // Shorthand for $this->setPerPageVisibilityStatus(true);
    $this->setPerPageVisibilityEnabled();
}
```

## setPerPageVisibilityDisabled

Disable per page visibility.

```php
public function configure(): void
{
    // Shorthand for $this->setPerPageVisibilityStatus(false);
    $this->setPerPageVisibilityDisabled();
}
```

---

## setPerPageAccepted

Set the accepted values for the per page dropdown. Defaults to `[10, 25, 50]`

```php
public function configure(): void
{
    $this->setPerPageAccepted([10, 25, 50, 100]);
}
```

**Note:** Set an option of `-1` to enable `All`.

## setPerPage

Set the default selected option of the per page dropdown.

```php
public function configure(): void
{
    $this->setPerPage(10);
}
```

**Note:** The value set must be included in the `per page accepted` values.
