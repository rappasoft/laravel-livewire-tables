<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Livewire\Attributes\Computed;

trait HasDefaultFilterInputStyling
{
    public ?string $defaultFilterInputColors;
    public ?string $defaultFilterInputStyling;

    protected function setDefaultFilterInputColors(string $defaultFilterInputColors): self
    {
        $this->defaultFilterInputColors = $defaultFilterInputColors;

        return $this;
    }

    protected function setDefaultFilterInputStyling(string $defaultFilterInputStyling): self
    {
        $this->defaultFilterInputStyling = $defaultFilterInputStyling;

        return $this;
    }

    public function hasDefaultFilterInputColors(): bool
    {
        return isset($this->defaultFilterInputColors);
    }

    #[Computed]
    public function getDefaultFilterInputColors(): string
    {
        if (isset($this->defaultFilterInputColors))
        {
            return $this->defaultFilterInputColors;
        }
        else
        {
            if ($this->isTailwind())
            {
                return 'border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600';
            }
            else
            {
                return '';
            }
        }   
     }

    public function hasDefaultFilterInputStyling(): bool
    {
        return isset($this->defaultFilterInputStyling);
    }
 
    #[Computed]
    public function getDefaultFilterInputStyling(): string
    {
        if (isset($this->defaultFilterInputStyling))
        {
            return $this->defaultFilterInputStyling;
        }
        else
        {
            if ($this->isTailwind())
            {
                return 'block w-full rounded-md shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50';
            }
            else
            {
                return 'form-control';
            }
        }
    }

}