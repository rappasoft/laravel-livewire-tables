<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait LazyPlaceholderHelpers
{
    public function getLazyPlaceholderEnabled(): bool
    {
        return $this->lazyPlaceholderEnabled;
    }

    public function hasLazyPlaceholderEnabled(): bool
    {
        return $this->getLazyPlaceholderEnabled();
    }

    public function hasLazyPlaceholderView(): bool
    {
        return ! is_null($this->getLazyPlaceholderView());
    }

    public function getLazyPlaceholderView(): ?string
    {
        return $this->lazyPlaceholderView;
    }

    /**
     * Returns the fallback Alpine x-data scope used by both the datatable
     * and lazy-placeholder wrapper views. Centralised here so the two
     * scopes can never drift out of sync.
     */
    public function getAlpineDefaultScope(): string
    {
        return '{ currentlyReorderingStatus: false, paginationTotalItemCount: 0, paginationCurrentCount: 0, paginationCurrentItems: [], selectedItems: [], selectAllStatus: false, delaySelectAll: false, hideBulkActionsWhenEmpty: false, reorderStatus: false, reorderDisplayColumn: false, shouldBeDisplayed: true, filtersOpen: false }';
    }
}
