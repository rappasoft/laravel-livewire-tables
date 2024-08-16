---
title: One Of Many Example
weight: 8
---

When trying to retrieve "OneOfMany", you may experience duplicate records.

Core functionality for this will be added in due course, this is simply a work-around.

In the meantime, to avoid this, you can use the following approach.

This example assumes two Models:
User -> HasMany -> Things

### Models
#### User
id
name
created_at
updated_at
etc

```php
    public function things(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Things::class);
    }
```

#### Things
id
name
user_id
created_at
updated_at

### Table
The following is the table code for this example, and retrieves the most recently created "Thing"

#### Column
```php
    Column::make('Latest Thing')
    ->label(
        fn ($row, Column $column) => $row->things->first()->name
    ),
```

#### Builder
```php
    public function builder(): Builder {

        return User::query()->with(['things' => function ($query) {
                $query->select(['id','user_id','name'])->orderBy('created_at', 'desc')->limit(1);
        }]);

    }
```

Core functionality for this will be added in due course, this is simply a work-around.