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

## setFooterTrAttributes

Set any attributes on the footer row element.

```php
public function configure(): void
{
    $this->setFooterTrAttributes(function($rows) {
        return ['class' => 'bg-gray-100'];
    });
}
```

By default, this replaces the default classes on the tr element, if you would like to keep them, set the default flag to true.

```php
public function configure(): void
{
    $this->setFooterTrAttributes(function($rows) {
        return [
            'default' => true,
            'class' => 'bg-gray-100'
        ];
    });
}
```

## setFooterTdAttributes

Set any attributes on the footer row cells.

```php
public function configure(): void
{
    $this->setFooterTdAttributes(function(Column $column, $rows) {
        if ($column->isField('id')) {
            return ['class' => 'text-red-500'];
        }
    });
}
```

By default, this replaces the default classes on the td element, if you would like to keep them, set the default flag to true.

```php
public function configure(): void
{
    $this->setFooterTdAttributes(function(Column $column, $rows) {
        if ($column->isField('id')) {
            return [
                'default' => true,
                'class' => 'text-red-500'
            ];
        }
    });
}
```

---

See also [footer column configuration](../columns/footer).