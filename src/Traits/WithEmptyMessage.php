<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\EmptyMessageConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\EmptyMessageHelpers;

trait WithEmptyMessage
{
    #[Locked]
    public string $customEmptyView = '';

    #[Locked]
    public array $customEmptyClasses = ['view' => '', 'row' => '', 'col' => '', 'div' => '', 'span' => ''];


    public function renderingWithEmptyMessage(\Illuminate\View\View $view, array $data = []): void
    {
        if ($this->customEmptyRowClasses == '' && $this->isTailwind())
        {
            $this->customEmptyRowClasses = 'bg-light bg-gray-50 dark:bg-gray-800 dark:text-white rappasoft-striped-row';
        }

    }
}
