---
title: Loaders
weight: 4
---

With the introduction of Livewire 3, there are several new methods available for use:

## Loading Placeholder
```php
public function configure(): void
{
  $this->setLoadingPlaceholderBlade('');
}
```

### setLoadingPlaceholderStatus
```php
public function configure(): void
{
  $this->setLoadingPlaceholderStatus(true);
}
```

### setLoadingPlaceholderEnabled
```php
public function configure(): void
{
  $this->setLoadingPlaceholderEnabled();
}
```


### setLoadingPlaceholderDisabled
```php
public function configure(): void
{
  $this->setLoadingPlaceholderDisabled();
}
```

### setLoadingPlaceholderContent
```php
public function configure(): void
{
  $this->setLoadingPlaceholderContent('');
}
```

### setLoadingPlaceHolderAttributes
```php
public function configure(): void
{
  $this->setLoadingPlaceHolderAttributes([]);
}
```

### setLoadingPlaceHolderIconAttributes
```php
public function configure(): void
{
  $this->setLoadingPlacehosetLoadingPlaceHolderIconAttributeslderBlade([]);
}
```

### setLoadingPlaceHolderWrapperAttributes
```php
public function configure(): void
{
  $this->setLoadingPlaceHolderWrapperAttributes([]);
}
```


### setLoadingPlaceholderBlade
```php
public function configure(): void
{
  $this->setLoadingPlaceholderBlade('');
}
```

## Lazy Loading

Tables support Livewire's `lazy` attribute out of the box:

```blade
<livewire:pets-table lazy />
```

The default placeholder is an empty element carrying the table's Alpine scope, which is what stops Alpine throwing `ReferenceError` while the real table is being loaded in. To show a skeleton instead, override `placeholder()` on your table and keep that scope:

```php
public function placeholder(): string
{
    return view('tables.pets-skeleton', ['scope' => $this->getAlpineFallbackScope()])->render();
}
```

```blade
{{-- tables/pets-skeleton.blade.php --}}
<div x-data="{{ $scope }}">
    <div class="animate-pulse h-64 bg-gray-100 dark:bg-gray-700 rounded-md"></div>
</div>
```
