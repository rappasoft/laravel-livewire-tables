---
title: Available Methods
weight: 1
---

These are the available configuration methods for the footer.

---


## setFooterStatus

Enabled by default, enable/disable the footer for the component.

```php
public function configure(): void
{
    $this->setFooterStatus(true);
    $this->setFooterStatus(false);
}
```

## setFooterEnabled

Enable the footer on the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFooterStatus(true);
    $this->setFooterEnabled();
}
```

## setFooterDisabled

Disable the footer on the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFooterStatus(false);
    $this->setFooterDisabled();
}
```

---

## setUseHeaderAsFooterStatus

Disabled by default, whether or not to use the secondary header as the footer.

```php
public function configure(): void
{
    $this->setUseHeaderAsFooterStatus(true);
    $this->setUseHeaderAsFooterStatus(false);
}
```

## setUseHeaderAsFooterEnabled

Use the secondary header as the footer.

```php
public function configure(): void
{
    // Shorthand for $this->setUseHeaderAsFooterStatus(true);
    $this->setUseHeaderAsFooterEnabled();
}
```

## setUseHeaderAsFooterDisabled

Use the footer as a stand-alone footer.

```php
public function configure(): void
{
    // Shorthand for $this->setUseHeaderAsFooterStatus(false);
    $this->setUseHeaderAsFooterDisabled();
}
```


---

See also 
[footer styling](./styling).
[footer column configuration](../columns/footer).