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
## setSearchPlaceholder

Set a custom placeholder for the search box

```php
public function configure(): void
{
    $this->setSearchPlaceholder('Enter Search Term');
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

## setTrimSearchStringEnabled

A new behaviour, which will trim search strings of whitespace at either end

```php
public function configure(): void
{
    // Will trim whitespace from either end of search strings
    $this->setTrimSearchStringEnabled();
}
```

## setTrimSearchStringDisabled

The default behaviour, does not trim search strings of whitespace.

```php
public function configure(): void
{
    // Will not trim whitespace from either end of search strings
    $this->setTrimSearchStringDisabled();
}
```

## Search Icon

To help customise, a "Search Input Icon" has been added, allowing for the addition of an icon to the search input field.

At present, the Search Icon is only available as a "left aligned" icon.

This is presently only available for Tailwind implementations

### setSearchIcon

This adds an Icon to the Search Input Field, which expects an icon path (e.g. heroicon-m-magnifying-glass)

```php
public function configure(): void
{
    $this->setSearchIcon('heroicon-m-magnifying-glass');
}
```

### setSearchIconAttributes

This allows you to specify attributes for the Search Icon for the Input Field.

Note that classes will be injected prior to styles, due to the behaviour of icons.

```php
public function configure(): void
{
    $this->setSearchIconAttributes([
        'class' => 'h-4 w-4',
        'style' => 'color: #000000',
    ]);
}

```