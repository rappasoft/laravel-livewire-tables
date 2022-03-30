---
title: Relationships
weight: 2
---

Out of the box the columns support `hasOne` and `belongsTo` relationships for display, sorting, and searching. The component will automatically join the necessary tables.

To call these relationships, just use the relationship dot-notation string as the field name:

```php
protected $model = User::class;

...

public function columns(): array {
    // Looks for the address column on the address relationship of User.
    // $user->address->address
    Column::make('Address', 'address.address'),
    
    // Looks for $user->address->group->name
    Column::make('Address Group', 'address.group.name'),
    
    // Looks for $user->address->group->city->name
    Column::make('Group City', 'address.group.city.name'),
}
```

The above will join the necessary tables as well as alias the columns for selecting, sorting, searching, etc.:

```sql
select `addresses`.`address` as `address.address`, `address_groups`.`name` as `address.group.name`, `cities`.`name` as `address.group.city.name` from `users` left join `addresses` on `addresses`.`user_id` = `users`.`id` left join `address_groups` on `addresses`.`address_group_id` = `address_groups`.`id` left join `cities` on `address_groups`.`city_id` = `cities`.`id`
```
