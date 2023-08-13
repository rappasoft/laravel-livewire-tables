---
title: Optional Packages
weight: 6
---

## Flatpickr
The DateRange filter makes use of Flatpickr, an open-source third party package.  You may enable this via one of the following three options:

### Option 1 - local installation (recommended)
Using your bundler of choice, install and include the Flatpickr library in your build.

*For example*
```
npm i flatpickr

```
Then in your app.js
```
import flatpickr from "flatpickr";
```
You should then disable both of the other options to avoid multiple (clashing) instances:
- Set the "published_third_party_assets" option to false in the configuration file
- Set the "remote_third_party_assets" option to false in the configuration file

### Option 2 - Using the included public directory
This sets the package to use a version of Flatpickr that has been tested and confirmed as working. 

Publish the included "public" directory
```
php artisan vendor:publish --provider="Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider" --tag=livewire-tables-public
```
- Set the "published_third_party_assets" option to true in the configuration file
- Set the "remote_third_party_assets" option to false in the configuration file

### Option 3 - Use the CDN options
This sets the package to use the published version from cdn.jsdelivr.net, note that you may experience breaking changes if Flatpickr makes major updates!

- Set the "published_third_party_assets" option to false in the configuration file
- Set the "remote_third_party_assets" option to true in the configuration file

