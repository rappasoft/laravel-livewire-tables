---
title: Configuration
weight: 3
---

You must implement the `configure` method on your component.

```php
public function configure(): void {}
```

The only configuration method that is required is `setPrimaryKey`.

```php
public function configure(): void {
    $this->setPrimaryKey('id');
}
```

The primary key is a field on your model that acts as a unique identifier for the row. I.e. an ID, a UUID, etc.
