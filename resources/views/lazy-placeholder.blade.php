<div
    x-data="{ currentlyReorderingStatus: false, paginationTotalItemCount: 0, paginationCurrentCount: 0, paginationCurrentItems: [], selectedItems: [], selectAllStatus: false, delaySelectAll: false, hideBulkActionsWhenEmpty: false, reorderStatus: false, reorderDisplayColumn: false, shouldBeDisplayed: true, filtersOpen: false }">
    @if($lazyPlaceholderContent ?? null)
        @include($lazyPlaceholderContent, ['isTailwind' => $isTailwind, 'isBootstrap' => $isBootstrap, 'isBootstrap4' => $isBootstrap4 ?? false, 'isBootstrap5' => $isBootstrap5 ?? false])
    @endif
</div>
