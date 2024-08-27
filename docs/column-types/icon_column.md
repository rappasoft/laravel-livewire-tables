---
title: Icon Columns (beta)
weight: 10
---

Icon columns provide a way to display icons in your table without having to use `format()` or partial views.

### setIcon
setIcon requires a valid path to an SVG (Directly or via a Library), it receives the $row, and $value (if available) to help you customise which icon to use
```php
IconColumn::make('Icon', 'status')
    ->setIcon(function ($row, $value) { 
        if($value == 1) { 
            return "heroicon-o-check-circle"; 
        } 
        else 
        {
            return "heroicon-o-x-circle"; 
        } 
    }),
```

### attributes
Attributes receives the $row, and $value (if available) to help you customise which attributes to apply, you may pass both classes, and other SVG specific attributes.
```php
IconColumn::make('Icon', 'status')
    ->setIcon(function ($row, $value) { if($value == 1) { return "heroicon-o-check-circle"; } else { return "heroicon-o-x-circle"; } })
    ->attributes(function ($row, $value) { 
        if($value == 1) { 
            return [
                'class' => 'w-6 h-6', 
                'stroke' => '#008000'
            ]; 
        } 
        else 
        {
            return [
                'class' => 'w-3 h-3', 
                'stroke' => '#FF0000'
            ]; 
        } 
    }),
```

For example:
### Example
```php
IconColumn::make('Icon', 'status')
    ->setIcon(function ($row, $value) { if($value == 1) { return "heroicon-o-check-circle"; } else { return "heroicon-o-x-circle"; } })
    ->attributes(function ($row, $value) { 
        if($value == 3) { 
            return [
                'class' => 'w-3 h-3', 
                'stroke' => '#008000'
            ]; 
        } 
        else if($value == 2) { 
            return [
                'class' => 'w-3 h-3', 
                'stroke' => '#0000FF'
            ]; 
        } 
        else 
        {
            return [
                'class' => 'w-3 h-3', 
                'stroke' => '#FF0000'
            ]; 
        } 
    }),
```

Please also see the following for other available methods:
<ul>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/available-methods">Available Methods</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/column-selection">Column Selection</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/secondary-header">Secondary Header</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/footer">Footer</a>
    </li>
</ul>