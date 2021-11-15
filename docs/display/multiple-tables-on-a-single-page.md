---
title: Multiple Tables
weight: 2
---

**Note:** Multiple tables on a single page currently have many limitations with the state and query strings, the only currently supported feature is pagination as it is saved in the session. Multiple tables per page will work if there are no duplicate columns/filters/etc. between them.

**However**, you can disable state for the tables, and they will work independently without the query string just know they will not retain their information on page load:

```php
protected $queryString = [];
```

When adding multiple tables to the same page, you will have issues with per page and pagination as they use the same keys. You can customize these values on a per-table basis so Laravel knows which page your switching, and so the component knows which 'per page' to remember for each table:

```php
// Change the page URL parameter for pagination
protected string $pageName = 'users';

// A unique name to identify the table in session variables
protected string $tableName = 'users';
```

**Note:** If you have multiple of the same table on the same page, they will inherit the same per page/pagination settings.
