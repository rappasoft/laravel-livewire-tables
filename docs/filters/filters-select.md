---
title: Select Filters
weight: 6
---

## Select Filters

Select filters are a simple dropdown list. The user selects one choice from the list.

```php
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

public function filters(): array
{
    return [
        SelectFilter::make('Active')
            ->options([
                '' => 'All',
                'yes' => 'Yes',
                'no' => 'No',
            ]),
    ];
}
```

### The default value

You should supply the first option as the default value. I.e. nothing selected, so the filter is not applied. This value should be an empty string. When this value is selected, the filter will be removed from the query and the query string.

### Option Groups

To use `<optgroup>` elements, pass a nested array of options to the select filter.

```php
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

public function filters(): array
{
    return [
        SelectFilter::make('Active')
            ->options([
                '' => 'All',
                'Open' => [
                    1 => 'Type A',
                    2 => 'Type B',
                    3 => 'Type C',
                ],
                'Closed' => [
                    24 => 'Type X',
                    25 => 'Type Y',
                    26 => 'Type Z',
                ],
            ])
            ->setFirstOption('All Tags'),
    ];
}
```
To set a default "All" option at the start of the dropdown, you can do so by utilising the 
```
->setFirstOption('NAME')
```
