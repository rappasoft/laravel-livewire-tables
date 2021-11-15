---
title: Creating filters
weight: 2
---

Creating filters is not required, and the filters box will be hidden if none are defined.

To create filters, you return an array of `Filter` class objects from the `filters()` method.

The current types of filters are: `select`, `multiSelect`, and `date`.

There are two steps to making a filter:

1. Adding the `Filter` object to `filters`.
2. Specifying how that filter acts on the `query`.

## 1. Adding the `Filter` object to `filters`.

```php
public function filters(): array
{
    return [
        'type' => Filter::make('User Type')
            ->select([
                '' => 'Any',
                User::TYPE_ADMIN => 'Administrators',
                User::TYPE_USER => 'Users',
            ]),
        'active' => Filter::make('Active')
            ->select([
                '' => 'Any',
                'yes' => 'Yes',
                'no' => 'No',
            ]),
        'verified' => Filter::make('E-mail Verified')
            ->select([
                '' => 'Any',
                1 => 'Yes',
                0 => 'No',
            ]),
         'date' => Filter::make('Date')
            ->date([
                'min' => now()->subYear()->format('Y-m-d'), // Optional
                'max' => now()->format('Y-m-d') // Optional
            ]),
         'tags' => Filter::make('Tags')
            ->multiSelect([
                'tag1' => 'Tags 1',
                'tag2' => 'Tags 2',
                'tag3' => 'Tags 3',
                'tag4' => 'Tags 4',
            ]),     
    ];
}
```

When using the select box filter, the keys of the options you supply will be validated on select to make sure they match one of the options on the backend, otherwise it will be changed to `null` for safety.

String or integer keys are supported.

## 2. Specifying how that filter acts on the 'query'.

To apply the filter in your query, you first check its existence, and then just append some constraints.

```php
public function query(): Builder
{
    return User::query()
        ->when($this->getFilter('type'), fn ($query, $type) => $query->where('type', $type))
        ->when($this->getFilter('active'), fn ($query, $active) => $query->where('active', $active === 'yes'));
}
```

As you can see we are just using the built-in Eloquent when method to check existence of our filter, and then apply the query.

### 2.1. Working with numeric keys:

If your filter has numeric keys, you may run into issues when you have a key that equals zero.

You will have to explicitly check:

```php
public function query(): Builder
{
    return User::with('attributes', 'parent')
        ->when($this->getFilter('email'), fn ($query, $email) => $email === 'yes' ? $query->whereNotNull('email') : $query->whereNull('email'))
        ->when($this->hasFilter('verified'), function ($query) {
            if ($this->getFilter('verified') === 1) {
                $query = $query->whereNotNull('email');
            } else {
                $query = $query->whereNull('email');
            }
        });
}
```
