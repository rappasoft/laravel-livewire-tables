---
title: Color Columns
weight: 6
---

Color columns provide an easy way to a Color in a Column

You may pass either pass a CSS-compliant colour as a field
```php
ColorColumn::make('Favourite Colour', 'favourite_color'),
```

Or you may use a Callback
```php
ColorColumn::make('Favourite Colour')
    ->color(
            function ($row) {
                if ($row->success_rate < 40)
                {
                    return '#ff0000';
                }
                else if ($row->success_rate > 90)
                {
                    return '#008000';
                }
                else return '#ffa500';
                    
            }
        ),
```

You may also specify attributes to use on the div displaying the color, to adjust the size or appearance, this receives the full row.  By default, this will replace the standard classes, to retain them, set "default" to true.  To then over-ride, you should prefix your classes with "!" to signify importance.
```php
    ColorColumn::make('Favourite Colour')
            ->attributes(function ($row) {
                return [
                    'class' => '!rounded-lg self-center',
                    'default' => true,
                ];
            }),
```


Please also see the following for other available methods:
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/available-methods](Available Methods)
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/column-selection](Column Selection)
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/secondary-header](Secondary Header)
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/footer](Footer)
