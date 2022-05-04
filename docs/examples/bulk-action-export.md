---
title: Bulk Action Export
weight: 3
---

Here's an example on exporting your data from a bulk action using [Laravel Excel](https://laravel-excel.com):

```php
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

public function bulkActions(): array
{
    return [
        'export' => 'Export',
    ];
}

public function export()
{
    $users = $this->getSelected();

    $this->clearSelected();

    return Excel::download(new UsersExport($users), 'users.xlsx');
}
```

The `UsersExport` class is a simple example of how to export data from a bulk action:

```php
<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    public $users;

    public function __construct($users) {
        $this->users = $users;
    }

    public function collection()
    {
        return User::whereIn('id', $this->users)->get();
    }
}
```