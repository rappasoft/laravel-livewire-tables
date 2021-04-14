<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

/**
 * Trait WithCustomPagination
 *
 * @package App\Http\Livewire\DataTable
 */
trait WithCustomPagination
{
    use WithPagination;

    public function pageName(): string
    {
        if (property_exists($this, 'pageName')) {
            if (! isset($this->{$this->pageName})) {
                $this->{$this->pageName} = 1;
            }

            return $this->pageName;
        }

        return 'page';
    }

    /**
     * @return array
     */
    public function getQueryString()
    {
        return array_merge([$this->pageName() => ['except' => 1]], $this->queryString);
    }

    public function initializeWithPagination(): void
    {
        $this->{$this->pageName()} = $this->resolvePage();

        Paginator::currentPageResolver(function () {
            return $this->{$this->pageName()};
        });

        Paginator::defaultView($this->paginationView());
    }


    public function previousPage(): void
    {
        $this->setPage($this->{$this->pageName()} - 1);
    }

    public function nextPage(): void
    {
        $this->setPage($this->{$this->pageName()} + 1);
    }

    public function setPage($page): void
    {
        $this->{$this->pageName()} = $page;
    }

    /**
     * @return array|null|string
     */
    public function resolvePage()
    {
        return request()->query($this->pageName(), $this->{$this->pageName()});
    }

    public function getPublicPropertiesDefinedBySubClass()
    {
        return tap(parent::getPublicPropertiesDefinedBySubClass(), function (&$props) {
            $props[$this->pageName()] = $this->{$this->pageName()};
        });
    }
}
