---
title: The Query
weight: 2
---

By default, the package will join any relationship tables it can, it will also eager-load any relationships if you chain the `eagerLoadRelations()` method on the column or call the `setEagerLoadAllRelationsEnabled()` method on the component configuration.

You have three ways of hooking up your data source: the model property, the builder method, or a collection.

## Using the model property

If you would like to create a simple table and know that you won't need to join any extra tables or use any aliases, then you can just use the model property:

```php
protected $model = User::class;
```

This just calls the query method on the model for you.

## Using the builder method

If you want more control over the query you may implement the `builder` method:

```php
public function builder(): Builder
{
    return User::query()
        ->with() // Eager load anything
        ->join() // Join some tables
        ->select(); // Select some things
}
```

## Using a collection

If your data isn't backed by a query at all (an API response, a computed in-memory set, or anything else you'd normally reach for [calebporzio/sushi](https://github.com/calebporzio/sushi) to fake a table for), you can implement the `collection` method instead:

```php
public function collection(): ?Collection
{
    return collect($this->computeRows());
}
```

When `collection()` returns something other than `null`, the table searches, filters, sorts, and paginates that collection directly instead of building a query. Filter callbacks receive the collection instead of a query builder:

```php
public function configure(): void
{
    $this->addFilter(
        TextFilter::make('Name')
            ->filter(function (Collection $items, string $value): Collection {
                return $items->filter(fn ($item) => str_contains($item->name, $value));
            })
    );
}
```

**Note:** bulk actions are not currently supported when using a collection data source.

Your component must implement one of `$model`, `builder()`, or `collection()`, or an exception will be thrown.
