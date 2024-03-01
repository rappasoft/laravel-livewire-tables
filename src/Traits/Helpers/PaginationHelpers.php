<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Livewire\Attributes\Computed;

trait PaginationHelpers
{
    public function getPageName(): ?string
    {
        return $this->pageName;
    }

    public function hasPageName(): bool
    {
        return $this->pageName !== null;
    }

    public function getPaginationStatus(): bool
    {
        return $this->paginationStatus;
    }

    public function getPaginationTheme(): string
    {
        return $this->paginationTheme;
    }

    public function paginationIsEnabled(): bool
    {
        return $this->getPaginationStatus() === true;
    }

    public function paginationIsDisabled(): bool
    {
        return $this->getPaginationStatus() === false;
    }

    public function getPaginationVisibilityStatus(): bool
    {
        return $this->paginationVisibilityStatus;
    }

    public function paginationVisibilityIsEnabled(): bool
    {
        return $this->getPaginationVisibilityStatus() === true;
    }

    public function paginationVisibilityIsDisabled(): bool
    {
        return $this->getPaginationVisibilityStatus() === false;
    }

    public function getComputedPageName(): string
    {
        $pageName = 'page';

        // If the component has a specific page name set
        if ($this->hasPageName()) {
            $pageName = $this->getPageName();
        } elseif (! $this->isTableNamed('table')) {
            // If the component has a custom table name but no custom page name
            $pageName = $this->getTableName().'Page';
        }

        return $pageName;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @return array<mixed>
     */
    public function getPerPageAccepted(): array
    {
        return $this->perPageAccepted;
    }

    public function getPerPageVisibilityStatus(): bool
    {
        return $this->perPageVisibilityStatus;
    }

    public function perPageVisibilityIsEnabled(): bool
    {
        return $this->getPerPageVisibilityStatus() === true;
    }

    public function perPageVisibilityIsDisabled(): bool
    {
        return $this->getPerPageVisibilityStatus() === false;
    }

    public function isPaginationMethod(string $paginationMethod): bool
    {
        return $this->paginationMethod === $paginationMethod;
    }

    /**
     * @return array<mixed>
     */
    public function getPerPageDisplayedItemIds(): array
    {
        return $this->paginationCurrentItems;
    }

    public function getPerPageDisplayedItemCount(): int
    {
        return $this->paginationCurrentCount;
    }

    public function showPaginationDetails(): bool
    {
        return $this->shouldShowPaginationDetails === true;
    }

    // TODO: Test
    public function setupPagination(): void
    {
        if ($this->paginationIsDisabled()) {
            return;
        }

        if (in_array(session($this->getPerPagePaginationSessionKey(), $this->getPerPage()), $this->getPerPageAccepted(), true)) {
            $this->setPerPage(session($this->getPerPagePaginationSessionKey(), $this->getPerPage()));
        } else {
            $this->setPerPage($this->getPerPageAccepted()[0] ?? 10);
        }
    }

    /**
     * Reset the page using the custom page name
     */
    public function resetComputedPage(): void
    {
        $this->resetPage($this->getComputedPageName());
    }

    private function getPerPagePaginationSessionKey(): string
    {
        return $this->tableName.'-perPage';
    }

    #[Computed]
    public function getPerPageFieldAttributes(): array
    {
        return $this->perPageFieldAttributes;
    }
}
