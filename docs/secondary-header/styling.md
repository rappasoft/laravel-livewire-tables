---
title: Styling
weight: 2
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
