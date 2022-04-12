---
title: Relationships
weight: 2
---

Out of the box the columns support `hasOne` and `belongsTo` relationships for display, sorting, and searching. The component will automatically join the necessary tables.

To call these relationships, just use the relationship dot-notation string as the field name:

```php
protected $model = User::class;

// ...

public function columns(): array {
    return [
        // Looks for the address column on the address relationship of User.
        // $user->address->address
        Column::make('Address', 'address.address'),
        
        // Looks for $user->address->group->name
        Column::make('Address Group', 'address.group.name'),
        
        // Looks for $user->address->group->city->name
        Column::make('Group City', 'address.group.city.name'),
    ];
}
```

The above will join the necessary tables as well as alias the columns for selecting, sorting, searching, etc.:

```sql
SELECT `addresses`.`address`   AS `address.address`,
       `address_groups`.`name` AS `address.group.name`,
       `cities`.`name`         AS `address.group.city.name`
FROM   `users`
       LEFT JOIN `addresses`
                 ON `addresses`.`user_id` = `users`.`id`
       LEFT JOIN `address_groups`
                 ON `addresses`.`address_group_id` = `address_groups`.`id`
       LEFT JOIN `cities`
                 ON `address_groups`.`city_id` = `cities`.`id` 
```
