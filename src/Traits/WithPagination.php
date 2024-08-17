<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Livewire\Attributes\Locked;
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

    #[Locked]
    public array $perPageAccepted = [10, 25, 50];

    #[Locked]
    public string $paginationTheme = 'tailwind';

    #[Locked]
    public bool $paginationStatus = true;

    #[Locked]
    public bool $paginationVisibilityStatus = true;

    #[Locked]
    public bool $perPageVisibilityStatus = true;

    // Entangled in JS
    public array $paginationCurrentItems = [];

    // Entangled in JS
    public int $paginationCurrentCount = 0;

    // Entangled in JS
    public ?int $paginationTotalItemCount = null;

    public array $numberOfPaginatorsRendered = [];

    // standard, simple, cursor
    protected string $paginationMethod = 'standard';

    protected bool $shouldShowPaginationDetails = true;

    protected array $perPageFieldAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    protected bool $shouldRetrieveTotalItemCount = true;

    public function mountWithPagination(): void
    {
        $sessionPerPage = session()->get($this->getPerPagePaginationSessionKey(), $this->getPerPageAccepted()[0] ?? 10);
        if (! in_array((int) $sessionPerPage, $this->getPerPageAccepted(), false)) {
            $sessionPerPage = $this->getPerPageAccepted()[0] ?? 10;
        }
        $this->setPerPage($sessionPerPage);
    }

    // TODO: Test
    public function updatedPerPage(int|string $value): void
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
