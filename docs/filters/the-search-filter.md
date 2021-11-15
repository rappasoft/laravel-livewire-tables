---
title: The search filter
weight: 3
---

Sometimes the default search behavior may not meet your requirements. If this is the case, skip using the searchable() method on columns and define your own behavior directly on the query.

```php
public function query(): Builder
{
    return User::query()
        ->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%'.$term.'%')
            ->orWhere('email', 'like', '%'.$term.'%'));
}
```

You can make this even more streamlined by adding a search scope to your model like so:

```php
public function scopeSearch($query, $term)
{
    return $query->where(
        fn ($query) => $query->where('name', 'like', '%'.$term.'%')
            ->orWhere('email', 'like', '%'.$term.'%')
    );
}
```

And then using it like this:

```php
public function query(): Builder
{
    return User::query()
        ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
}
```
