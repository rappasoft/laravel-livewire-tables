---
title: Text Filters
weight: 10
---

Text filters are just simple text fields.

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

### Extra Helpers

There are a number of helpers to simplify your code, should you not wish to rewrite the filter function repeatedly for a Text Filter.  You can only use one of the below methods per-filter.

#### Contains

This executes the filter and returns results where the field contains the filter value

```php
public function filters(): array
{
    return [
        TextFilter::make('Name')
            ->config([
                'placeholder' => 'Search Name',
                'maxlength' => '25',
            ])
            ->contains('users.name'),
    ];
}
```

#### notContains

This executes the filter and returns results where the field does not contain filter value

```php
public function filters(): array
{
    return [
        TextFilter::make('Name')
            ->config([
                'placeholder' => 'Search Name',
                'maxlength' => '25',
            ])
            ->notContains('users.name'),
    ];
}
```

#### startsWith

This executes the filter and returns results where the field starts with the filter value

```php
public function filters(): array
{
    return [
        TextFilter::make('Name')
            ->config([
                'placeholder' => 'Search Name',
                'maxlength' => '25',
            ])
            ->startsWith('users.name'),
    ];
}
```

#### notStartsWith

This executes the filter and returns results where the field does not start with the filter value

```php
public function filters(): array
{
    return [
        TextFilter::make('Name')
            ->config([
                'placeholder' => 'Search Name',
                'maxlength' => '25',
            ])
            ->notStartsWith('users.name'),
    ];
}
```

#### endsWith

This executes the filter and returns results where the field ends with the filter value

```php
public function filters(): array
{
    return [
        TextFilter::make('Name')
            ->config([
                'placeholder' => 'Search Name',
                'maxlength' => '25',
            ])
            ->endsWith('users.name'),
    ];
}
```

#### notEndsWith

This executes the filter and returns results where the field does not end with the filter value

```php
public function filters(): array
{
    return [
        TextFilter::make('Name')
            ->config([
                'placeholder' => 'Search Name',
                'maxlength' => '25',
            ])
            ->notEndsWith('users.name'),
    ];
}
```

#### setField
An optional method for setting the field to use when filtering, if used, you may omit the field from the above methods, for example:

```php
public function filters(): array
{
    return [
        TextFilter::make('Name')
            ->config([
                'placeholder' => 'Search Name',
                'maxlength' => '25',
            ])
            ->setField('users.name')
            ->contains(),
    ];
}
```
