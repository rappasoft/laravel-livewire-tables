---
title: Creating Filters
weight: 2
---

To create filters, you must implement the `filters()` method on your component.

```php
public function filters(): array
{
    return [];
}
```

This method will return an array of filter objects. There are a few filter types to choose from:

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

## Multi-select Filters

Multi-select filters are a list of checkboxes. The user can select multiple options from the list. There is also an 'All' option that will select all values.

```php
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

public function filters(): array
{
    return [
        MultiSelectFilter::make('Tags')
            ->options(
                Tag::query()
                    ->orderBy('name')
                    ->get()
                    ->keyBy('id')
                    ->map(fn($tag) => $tag->name)
                    ->toArray()
            ),
    ];
}
```

## Date Filters

Date filters are HTML date elements.

```php
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

public function filters(): array
{
    return [
        DateFilter::make('Verified From'),
    ];
}
```

Date filters have options to set min and max:

```php
public function filters(): array
{
    return [
        DateFilter::make('Verified From')
            ->config([
                'min' => '2020-01-01',
                'max' => '2021-12-31',
            ])
    ];
}
```

## DateTime Filters

DateTime filters are HTML datetime-local elements and act the same as date filters.

Make sure to look at [all available configurations](available-methods#filter-methods) on the Filter classes.

## Text Filters

Text filters are just HTML text fields.

```php
public function filters(): array
{
    return [
        TextFilter::make('Name')
            ->config([
                'placeholder' => 'Search Name',
                'maxlength' => '25',
            ])
            ->filter(function(Builder $builder, string $value) {
                $builder->where('users.name', 'like', '%'.$value.'%');
            }),
    ];
}
```

## Filter Keys

By default, the filter key is just the snake version of the filter name. This is used to generate the query string as well as look up the filter object in necessary places. Each filter should have a unique key.

You can override this by supplying a custom key:

```php
SelectFilter::make('Active', 'user_status')
```

Yields a query string of:

```
?table[filters][user_status]=yes
```

Instead of:

```
?table[filters][active]=yes
```

## A note about values

Your values should be strings. If you want to use a number, you should convert it to a string.

Since the frontend HTML elements treat all values as strings, it makes it easier to work with strings everywhere and convert them to integers where you need to. This is no different than submitting a form with integer values in a dropdown, they still make it to the server as strings.
