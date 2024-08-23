---
title: Styling
weight: 2
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
