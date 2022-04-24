---
title: Advanced Example
weight: 2
---

```php
<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

class UsersTable extends DataTableComponent
{
    public string $tableName = 'users';
    public array $users = [];
    
    public $columnSearch = [
        'name' => null,
        'email' => null,
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setReorderEnabled()
            ->setSingleSortingDisabled()
            ->setHideReorderColumnUnlessReorderingEnabled()
            ->setFilterLayoutSlideDown()
            ->setRememberColumnSelectionDisabled()
            ->setSecondaryHeaderTrAttributes(function($rows) {
                return ['class' => 'bg-gray-100'];
            })
            ->setSecondaryHeaderTdAttributes(function(Column $column, $rows) {
                if ($column->isField('id')) {
                    return ['class' => 'text-red-500'];
                }

                return ['default' => true];
            })
            ->setFooterTrAttributes(function($rows) {
                return ['class' => 'bg-gray-100'];
            })
            ->setFooterTdAttributes(function(Column $column, $rows) {
                if ($column->isField('name')) {
                    return ['class' => 'text-green-500'];
                }

                return ['default' => true];
            })
            ->setUseHeaderAsFooterEnabled()
            ->setHideBulkActionsWhenEmptyEnabled();
    }

    public function columns(): array
    {
        return [
            ImageColumn::make('Avatar')
                ->location(function($row) {
                    return asset('img/logo-'.$row->id.'.png');
                })
                ->attributes(function($row) {
                    return [
                        'class' => 'w-8 h-8 rounded-full',
                    ];
                }),
            Column::make('Order', 'sort')
                ->sortable()
                ->collapseOnMobile()
                ->excludeFromColumnSelect(),
            Column::make('ID', 'id')
                ->sortable()
                ->setSortingPillTitle('Key')
                ->setSortingPillDirections('0-9', '9-0')
                ->secondaryHeader(function($rows) {
                    return $rows->sum('id');
                })
                ->html(),
            Column::make('Name')
                ->sortable()
                ->searchable()
                ->view('tables.cells.actions')
                ->secondaryHeader(function() {
                    return view('tables.cells.input-search', ['field' => 'name', 'columnSearch' => $this->columnSearch]);
                })
                ->html(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable()
                ->secondaryHeader(function() {
                    return view('tables.cells.input-search', ['field' => 'email', 'columnSearch' => $this->columnSearch]);
                }),
            Column::make('Address', 'address.address')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Address Group', 'address.group.name')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Group City', 'address.group.city.name')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            BooleanColumn::make('Active')
                ->sortable()
                ->collapseOnMobile(),
            Column::make('Verified', 'email_verified_at')
                ->sortable()
                ->collapseOnTablet(),
            Column::make('Tags')
                ->label(fn($row) => $row->tags->pluck('name')->implode(', '))
        ];
    }

    public function filters(): array
    {
        return [
            MultiSelectFilter::make('Tags')
                ->options(
                    Tag::query()
                        ->orderBy('name')
                        ->get()
                        ->keyBy('id')
                        ->map(fn($tag) => $tag->name)
                        ->toArray()
                )->filter(function(Builder $builder, array $values) {
                    $builder->whereHas('tags', fn($query) => $query->whereIn('tags.id', $values));
                })
                ->setFilterPillValues([
                    '3' => 'Tag 1',        
                ]),
            SelectFilter::make('E-mail Verified', 'email_verified_at')
                ->setFilterPillTitle('Verified')
                ->options([
                    ''    => 'Any',
                    'yes' => 'Yes',
                    'no'  => 'No',
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value === 'yes') {
                        $builder->whereNotNull('email_verified_at');
                    } elseif ($value === 'no') {
                        $builder->whereNull('email_verified_at');
                    }
                }),
            SelectFilter::make('Active')
                ->setFilterPillTitle('User Status')
                ->setFilterPillValues([
                    '1' => 'Active',
                    '0' => 'Inactive',
                ])
                ->options([
                    '' => 'All',
                    '1' => 'Yes',
                    '0' => 'No',
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('active', true);
                    } elseif ($value === '0') {
                        $builder->where('active', false);
                    }
                }),
            DateFilter::make('Verified From')
                ->config([
                    'min' => '2020-01-01',
                    'max' => '2021-12-31',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('email_verified_at', '>=', $value);
                }),
            DateFilter::make('Verified To')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('email_verified_at', '<=', $value);
                }),
        ];
    }

    public function builder(): Builder
    {
        return User::query()
            ->when($this->columnSearch['name'] ?? null, fn ($query, $name) => $query->where('users.name', 'like', '%' . $name . '%'))
            ->when($this->columnSearch['email'] ?? null, fn ($query, $email) => $query->where('users.email', 'like', '%' . $email . '%'));
    }

    public function bulkActions(): array
    {
        return [
            'activate' => 'Activate',
            'deactivate' => 'Deactivate',
        ];
    }

    public function activate()
    {
        User::whereIn('id', $this->getSelected())->update(['active' => true]);

        $this->clearSelected();
    }

    public function deactivate()
    {
        User::whereIn('id', $this->getSelected())->update(['active' => false]);

        $this->clearSelected();
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            User::find((int)$item['value'])->update(['sort' => (int)$item['order']]);
        }
    }
}
```

**input-search.blade.php**

```html
@if (config('livewire-tables.theme') === 'tailwind')
    <div class="flex rounded-md shadow-sm">
        <input
            wire:model.debounce="columnSearch.{{ $field }}"
            placeholder="Search {{ ucfirst($field) }}"
            type="text"
            class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-800 dark:text-white dark:border-gray-600 @if (isset($columnSearch[$field]) && strlen($columnSearch[$field])) rounded-none rounded-l-md focus:ring-0 focus:border-gray-300 @else focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md @endif"
        />

        @if (isset($columnSearch[$field]) && strlen($columnSearch[$field]))
            <span wire:click="$set('columnSearch.{{ $field }}', null)" class="inline-flex items-center px-3 text-gray-500 border border-l-0 border-gray-300 cursor-pointer bg-gray-50 rounded-r-md sm:text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
        @endif
    </div>
@endif

@if (config('livewire-tables.theme') === 'bootstrap-4')
    <div class="mb-3 mb-md-0 input-group">
        <input
            wire:model.debounce="columnSearch.{{ $field }}"
            placeholder="Search {{ ucfirst($field) }}"
            type="text"
            class="form-control"
        >

        @if (isset($columnSearch[$field]) && strlen($columnSearch[$field]))
            <div class="input-group-append">
                <button wire:click="$set('columnSearch.{{ $field }}', null)" class="btn btn-outline-secondary" type="button">
                    <svg style="width:.75em;height:.75em" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
    </div>
@endif

@if (config('livewire-tables.theme') === 'bootstrap-5')
    <div class="mb-3 mb-md-0 input-group">
        <input
            wire:model.debounce="columnSearch.{{ $field }}"
            placeholder="Search {{ ucfirst($field) }}"
            type="text"
            class="form-control"
        >

        @if (isset($columnSearch[$field]) && strlen($columnSearch[$field]))
            <button wire:click="$set('columnSearch.{{ $field }}', null)" class="btn btn-outline-secondary" type="button">
                <svg style="width:.75em;height:.75em" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        @endif
    </div>
@endif
```