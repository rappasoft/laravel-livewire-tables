<?php

declare(strict_types=1);

namespace Rappasoft\LaravelLivewireTables\Traits;

use Livewire\Attributes\Locked;
use Livewire\WithPagination as LivewirePagination;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\PaginationConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\PaginationHelpers;

/**
 * Pagination functionality for DataTableComponent
 */
trait WithPagination
{
    use LivewirePagination,
        PaginationConfiguration,
        PaginationHelpers;

    /**
     * Custom page name for query string
     */
    public ?string $pageName = null;

    /**
     * Items per page
     */
    public int $perPage = 10;

    /**
     * Accepted per page values (locked from frontend)
     * @var array<int, int>
     */
    #[Locked]
    public array $perPageAccepted = [10, 25, 50];

    /**
     * Pagination theme (tailwind/bootstrap)
     */
    #[Locked]
    public string $paginationTheme = 'tailwind';

    /**
     * Whether pagination is enabled
     */
    #[Locked]
    public bool $paginationStatus = true;

    /**
     * Whether pagination controls are visible
     */
    #[Locked]
    public bool $paginationVisibilityStatus = true;

    /**
     * Whether per-page selector is visible
     */
    #[Locked]
    public bool $perPageVisibilityStatus = true;

    /**
     * Current page items (entangled with JS)
     * @var array<int, mixed>
     */
    public array $paginationCurrentItems = [];

    /**
     * Current page item count (entangled with JS)
     */
    public int $paginationCurrentCount = 0;

    /**
     * Total item count (entangled with JS)
     */
    public ?int $paginationTotalItemCount = null;

    /**
     * Track number of paginators rendered
     * @var array<string, int>
     */
    public array $numberOfPaginatorsRendered = [];

    /**
     * Pagination method: standard, simple, or cursor
     */
    protected string $paginationMethod = 'standard';

    /**
     * Whether to show pagination details
     */
    protected bool $shouldShowPaginationDetails = true;

    /**
     * Per-page field attributes
     * @var array<string, mixed>
     */
    protected array $perPageFieldAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    /**
     * Whether to retrieve total item count
     */
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

    public function renderingWithPagination(?\Illuminate\View\View $view = null, array $data = []): void
    {
        $this->setupPagination();
    }
}
