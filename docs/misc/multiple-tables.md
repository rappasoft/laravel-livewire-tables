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

## Disabling column selection for multiple of the same component

You should also disable the columns selection for those components so the query string and session state does not get replaced by one or the other:

```php
public function configure(): void
{
    $this->setColumnSelectStatus(true);
    $this->setColumnSelectStatus(false);
}
```
