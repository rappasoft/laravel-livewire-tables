@aware(['tableName'])
<div {{ 
        $attributes->merge($this->getPerPageWrapperAttributes())
        ->class([
            'ml-0 ml-md-2' => $this->isBootstrap4 && ($this->getPerPageWrapperAttributes()['default-styling'] ?? true),
            'ms-0 ms-md-2' => $this->isBootstrap5 && ($this->getPerPageWrapperAttributes()['default-styling'] ?? true),
        ])
        ->except(['default','default-styling','default-colors']) 
    }}>
    <select wire:model.live="perPage" id="{{ $tableName }}-perPage" {{ 
            $attributes->merge($this->getPerPageFieldAttributes())
            ->class([
                'form-control' => $this->isBootstrap4 && ($this->getPerPageFieldAttributes()['default-styling'] ?? true),
                'form-select' => $this->isBootstrap5 && ($this->getPerPageFieldAttributes()['default-styling'] ?? true),
                'block w-full rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:ring focus:ring-opacity-50' => $this->isTailwind && (($this->getPerPageFieldAttributes()['default'] ?? false) || ($this->getPerPageFieldAttributes()['default-styling'] ?? true)),
                'border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600' => $this->isTailwind && (($this->getPerPageFieldAttributes()['default'] ?? false) || ($this->getPerPageFieldAttributes()['default-colors'] ?? true)),
            ])
            ->except(['default','default-styling','default-colors']) 
        }}>

        @foreach ($this->getPerPageAccepted() as $item)
            <option value="{{ $item }}" wire:key="{{ $tableName }}-per-page-{{ $item }}">
                {{ $item === -1 ? __('livewire-tables::All') : $item }}
            </option>
        @endforeach
    </select>
</div>
