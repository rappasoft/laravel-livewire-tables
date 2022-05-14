---
title: Multiple Tables Same Page
weight: 2
---

This feature works for mutiple tables on the same page that are **different** components.

This feature **does not work** for multiple tables on the same page that are the **same component** but take different parameters.

---

For example, this works:

```html
<livewire:users-table />

<livewire:roles-table />
```

But this does not work:

```html
<livewire:users-table status="active" />

<livewire:users-table status="pending" />
```

If you need the above, you should make them different components like so:

```html
<livewire:active-users-table />

<livewire:pending-users-table />
```

## Disabling the query string for multiple of the same component

If you must have multiple of the same component on the same page, you should disable the query string for those components so the query string state does not get replaced by one or the other:

```php
public function configure(): void
{
    $this->setQueryStringDisabled();
}
```

## Fingerprinting multiple of the same component

If you must have multiple of the same component on the same page, and you also need column selection enabled, you can override `dataTableFingerprint()` for one or more of the components:

```php
public ?string $uniqueIdentifier;

public function mount($uniqueIdentifier = null)
{
    $this->uniqueIdentifier = $uniqueIdentifier
}

/**
 * returns a unique id for the table, used as an alias to identify one table from another session and query string to prevent conflicts
 */
public function dataTableFingerprint(): string
{
    return $this->uniqueIdentifier ?? parent::dataTableFingerprint();
}
```

```html
<livewire:users-table status="active" />

<livewire:users-table status="pending" uniqueIdentifier="pending-users" />
```

The property name `$uniqueIdentifier` here is arbitrary -- you may call it anything you like. It is just being used here as an example of how one may pass in a unique identifier to be returned by the `dataTableFingerprint()` method.
