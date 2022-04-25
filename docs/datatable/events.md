---
title: Events
weight: 2
---

These are the available events on the datatable component that you can fire from your application:

### refreshDatatable

```php
$this->emit('refreshDatatable');
```

Calls `$refresh` on the component. Good for updating from external sources or as an alternative to polling.