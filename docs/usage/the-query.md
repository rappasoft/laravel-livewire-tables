---
title: The Query
weight: 2
---

By default, the package will join any relationship tables it can, it will also eager-load any relationships if you chain the `eagerLoadRelations()` method on the column or call the `setEagerLoadAllRelationsEnabled()` method on the component configuration.

This package only currently supports Eloquent models. You have two ways of hooking up your model.

**Note:** You can try [calebporzio/sushi](https://github.com/calebporzio/sushi) for arrays.

## Using the model property

If you have a simple table and you know you won't to join any extra tables or make any aliases, you can just use the model property:

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

Your component must implement one of these methods or an exception will be thrown.
