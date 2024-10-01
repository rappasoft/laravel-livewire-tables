---
title: Styling
weight: 2
---


## setPaginationWrapperAttributes

Used to set attributes for the "div" that wraps the pagination section (typically in the footer)

```php
public function configure(): void
{
    $this->setPaginationWrapperAttributes(['class' => 'text-lg']);
}
```

## setPerPageFieldAttributes
Allows for customisation of the appearance of the "Per Page" dropdown

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

### default-colors
Setting to false will disable the default colors for the Per Page dropdown, the default colors are:
Bootstrap: 
None

Tailwind: 
border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600

### default-styling
Setting to false will disable the default styling for the Per Page dropdown, the default styling is:
Bootstrap 4:
form-control

Bootstrap 5:
form-select

Tailwind:
block w-full rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:ring focus:ring-opacity-50

```php
public function configure(): void
{
    $this->setPerPageFieldAttributes([
        'class' => 'border-red-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-red-700 dark:text-white dark:border-red-600', // Add these classes to the dropdown
        'default-colors' => false, // Do not output the default colors
        'default-styles' => true, // Output the default styling
    ]);
}
```

## setPerPageWrapperAttributes
Allows for customisation of the appearance of the wrapper for the "Per Page" dropdown

```php
public function configure(): void
{
    $this->setPerPageWrapperAttributes([
        'class' => 'bg-blue-500 text-black dark:bg-red-700 dark:text-white ',
        'default-colors' => false, // Do not output the default colors
        'default-styles' => true, // Output the default styling
    ]);
}
```
