---
title: Advanced Example
weight: 2
---

The DataTable plugin has many advanced features from bulk exporting, custom views, custom searching/sorting, filtering, column selection, drag & drop reordering, etc.

There will be sections of the wiki to go into these in detail, but this is an example of a table with a custom row, filters, and bulk exporting:

```php
<?php

namespace App\Http\Livewire\Admin\User;

use App\Domains\Auth\Models\User;
use App\Domains\User\Exports\UserExport;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class UsersTable extends DataTableComponent
{

    public array $sortNames = [
        'email_verified_at' => 'Verified',
        'two_factor_secret' => '2FA',
    ];

    public array $filterNames = [
        'type' => 'User Type',
        'verified' => 'E-mail Verified',
        '2fa' => 'Two Factor Authentication',
    ];

    public array $bulkActions = [
        'exportSelected' => 'Export',
    ];

    protected string $pageName = 'users';
    protected string $tableName = 'users';

    public function exportSelected()
    {
        if ($this->selectedRowsQuery->count() > 0) {
            return (new UserExport($this->selectedRowsQuery))->download($this->tableName.'.xlsx');
        }

        // Not included in package, just an example.
        $this->notify(__('You did not select any users to export.'), 'danger');
    }

    public function filters(): array
    {
        return [
            'type' => Filter::make('User Type')
                ->select([
                    '' => 'Any',
                    User::TYPE_ADMIN => 'Administrators',
                    User::TYPE_USER => 'Users',
                ]),
            'active' => Filter::make('Active')
                ->select([
                    '' => 'Any',
                    'yes' => 'Yes',
                    'no' => 'No',
                ]),
            'verified' => Filter::make('E-mail Verified')
                ->select([
                    '' => 'Any',
                    'yes' => 'Yes',
                    'no' => 'No',
                ]),
            '2fa' => Filter::make('Two Factor Authentication')
                ->select([
                    '' => 'Any',
                    'enabled' => 'Enabled',
                    'disabled' => 'Disabled',
                ]),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make('Type')
                ->sortable()
                ->addClass('hidden md:table-cell'),
            Column::make('Name')
                ->sortable(),
            Column::make('E-mail', 'email')
                ->sortable(),
            Column::make('Active')
                ->sortable()
                ->addClass('hidden md:table-cell'),
            Column::make('Verified', 'email_verified_at')
                ->sortable()
                ->addClass('hidden md:table-cell'),
            Column::make('2FA', 'two_factor_secret')
                ->sortable()
                ->addClass('hidden md:table-cell'),
            Column::blank(),
        ];
    }

    public function query(): Builder
    {
        return User::query()
            ->when($this->getFilter('search'), fn ($query, $search) => $query->search($search))
            ->when($this->getFilter('type'), fn ($query, $type) => $query->where('type', $type))
            ->when($this->getFilter('active'), fn ($query, $active) => $query->where('active', $active === 'yes'))
            ->when($this->getFilter('verified'), fn ($query, $verified) => $verified === 'yes' ? $query->whereNotNull('email_verified_at') : $query->whereNull('email_verified_at'))
            ->when($this->getFilter('2fa'), fn ($query, $twoFactor) => $twoFactor === 'enabled' ? $query->whereNotNull('two_factor_secret') : $query->whereNull('two_factor_secret'));
    }

    public function rowView(): string
    {
        return 'location.to.my.row.view';
    }
}
```

It's associated custom row:

**row.blade.php**

```html
<x-livewire-tables::table.cell class="hidden md:table-cell">
    <div>
        @if ($row->isAdmin())
            <x-badges.success>{{ ucfirst($row->type) }}</x-badges.success>
        @else
            <x-badges.default>{{ ucfirst($row->type) }}</x-badges.default>
        @endif
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="flex items-center">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div wire:key="profile-picture-{{ $row->id }}" class="flex-shrink-0 h-10 w-10">
                <img class="h-10 w-10 rounded-full" src="{{ $row->profile_photo_url }}" alt="{{ $row->name }}" />
            </div>
        @endif

        <div class="@if (Laravel\Jetstream\Jetstream::managesProfilePhotos()) ml-4 @endif">
            <div class="text-sm font-medium text-gray-900">
                {{ $row->name }}
            </div>

            @if($row->timezone)
                <div wire:key="timezone-{{ $row->id }}" class="text-sm text-gray-500">
                    {{ str_replace('_', ' ', $row->timezone) }}
                </div>
            @endif
        </div>
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <p class="text-blue-400 truncate">
        <a href="mailto:{{ $row->email }}" class="hover:underline">{{ $row->email }}</a>
    </p>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="hidden md:table-cell">
    <div>
        @if ($row->isActive())
            <x-badges.success>@lang('Yes')</x-badges.success>
        @else
            <x-badges.danger>@lang('No')</x-badges.danger>
        @endif
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="hidden md:table-cell">
    <div>
        @if ($row->isVerified())
            <x-badges.success>@lang('Yes')</x-badges.success>
        @else
            <x-badges.danger>@lang('No')</x-badges.danger>
        @endif
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="hidden md:table-cell">
    <div>
        @if ($row->twoFactorEnabled())
            <x-badges.success>@lang('Enabled')</x-badges.success>
        @else
            <x-badges.danger>@lang('Disabled')</x-badges.danger>
        @endif
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <a href="#" wire:click.prevent="manage({{ $row->id }})" class="text-primary-600 font-medium hover:text-primary-900">Manage</a>
</x-livewire-tables::table.cell>
```
