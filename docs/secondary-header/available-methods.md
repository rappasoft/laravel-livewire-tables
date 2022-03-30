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

## setSecondaryHeaderTrAttributes

Set any attributes on the secondary header row element.

```php
public function configure(): void
{
    $this->setSecondaryHeaderTrAttributes(function($rows) {
        return ['class' => 'bg-gray-100'];
    });
}
```

By default, this replaces the default classes on the tr element, if you would like to keep them, set the default flag to true.

```php
public function configure(): void
{
    $this->setSecondaryHeaderTrAttributes(function($rows) {
        return [
            'default' => true,
            'class' => 'bg-gray-100'
        ];
    });
}
```

## setSecondaryHeaderTdAttributes

Set any attributes on the secondary header row cells.

```php
public function configure(): void
{
    $this->setSecondaryHeaderTdAttributes(function(Column $column, $rows) {
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
    $this->setSecondaryHeaderTdAttributes(function(Column $column, $rows) {
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

See also [secondary header column configuration](../columns/secondary-header).