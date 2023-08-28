---
title: Available Methods
weight: 1
---

These are the available search configuration methods on the component.

---

If you need to programmatically set the search for when the component loads:

## setSearch

```php
public function configure(): void
{
    $this->setSearch('Laravel');
}
```

Search as a whole is **enabled by default**, but if you ever needed to toggle it you can use the following methods:

## setSearchStatus

Enable/disable sorting for the whole component.

```php
public function configure(): void
{
    $this->setSearchStatus(true);
    $this->setSearchStatus(false);
}
```

## setSearchEnabled

Enable search for the whole component.

```php
public function configure(): void
{
    // Shorthand for $this->setSearchStatus(true)
    $this->setSearchEnabled();
}
```

Disable search for the whole component.

## setSearchDisabled

```php
public function configure(): void
{
    // Shorthand for $this->setSearchStatus(false)
    $this->setSearchDisabled();
}
```

---

## setSearchVisibilityStatus

Show/hide the search box.

```php
public function configure(): void
{
    $this->setSearchVisibilityStatus(true);
    $this->setSearchVisibilityStatus(false);
}
```

## setSearchVisibilityEnabled

Show the search box.

```php
public function configure(): void
{
    // Shorthand for $this->setSearchVisibilityStatus(true)
    $this->setSearchVisibilityEnabled();
}
```

## setSearchVisibilityDisabled

Hide the search box.

```php
public function configure(): void
{
    // Shorthand for $this->setSearchVisibilityStatus(false)
    $this->setSearchVisibilityDisabled();
}
```

---

You can only set one of the follow search modifiers:

## setSearchDebounce

Set a search debounce in milliseconds on the search box:

```php
public function configure(): void
{
    // Search will wait 1 second before sending request.
    $this->setSearchDebounce(1000);
}
```

## setSearchDefer

Tell Livewire to `defer` the search request until the following request.

```php
public function configure(): void
{
    // Send the search request with the next network request
    $this->setSearchDefer();
}
```

## setSearchLive

Tell Livewire to immediately update the search

```php
public function configure(): void
{
    // Send the search request immediately
    $this->setSearchLive();
}
```

## setSearchBlur

Tell Livewire to update the search when focus is changed from the text box.

```php
public function configure(): void
{
    // Send the search request once focus changes
    $this->setSearchBlur();
}
```

## setSearchThrottle

Tell Livewire to throttle updates

```php
public function configure(): void
{
    // Search will throttle to every 1 second
    $this->setSearchThrottle(1000);
}
```
