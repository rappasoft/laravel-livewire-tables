<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Livewire\WithPagination as LivewirePagination;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\PaginationConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\PaginationHelpers;

trait WithPagination
{
    use LivewirePagination,
        PaginationConfiguration,
        PaginationHelpers;

    public ?string $pageName = null;

    public int $perPage = 10;

    public array $perPageAccepted = [10, 25, 50];

    public string $paginationTheme = 'tailwind';

    public bool $paginationStatus = true;

    public bool $paginationVisibilityStatus = true;

    public bool $perPageVisibilityStatus = true;

    // standard, simple, cursor
    protected string $paginationMethod = 'standard';

    public array $paginationCurrentItems = [];

    public int $paginationCurrentCount = 0;

    public ?int $paginationTotalItemCount = null;

    public array $numberOfPaginatorsRendered = [];

    protected bool $shouldShowPaginationDetails = true;

    protected array $perPageFieldAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    public function mountWithPagination(): void
    {
        $sessionPerPage = session()->get($this->getPerPagePaginationSessionKey(), $this->getPerPageAccepted()[0] ?? 10);
        if (! in_array((int) $sessionPerPage, $this->getPerPageAccepted(), false)) {
            $sessionPerPage = $this->getPerPageAccepted()[0] ?? 10;
        }
        $this->setPerPage($sessionPerPage);
    }

    // TODO: Test
    public function updatedPerPage($value): void
    {
        if (! in_array((int) $value, $this->getPerPageAccepted(), false)) {
            $value = $this->getPerPageAccepted()[0] ?? 10;
        }

        if (in_array(session($this->getPerPagePaginationSessionKey(), (int) $value), $this->getPerPageAccepted(), true)) {
            session()->put($this->getPerPagePaginationSessionKey(), (int) $value);
        } else {
            session()->put($this->getPerPagePaginationSessionKey(), $this->getPerPageAccepted()[0] ?? 10);
        }
        $this->setPerPage($value);
    }

    protected function queryStringWithPagination(): array
    {

        if ($this->queryStringIsEnabled()) {
            return [
                'perPage' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAlias().'perPage'],
            ];
        }

        return [];
    }

    public function renderingWithPagination(): void
    {
        $this->setupPagination();
    }
}
