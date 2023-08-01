/*jshint esversion: 6 */

document.addEventListener('alpine:init', () => {
    Alpine.data('tableWrapper', (wire, showBulkActionsAlpine) => ({
        filtersOpen: wire.entangle('filterSlideDownDefaultVisible'),
        paginationCurrentCount: wire.entangle('paginationCurrentCount').live,
        paginationTotalItemCount: wire.entangle('paginationTotalItemCount').live,
        paginationCurrentItems: wire.entangle('paginationCurrentItems').live,
        selectedItems: wire.entangle('selected'),
        alwaysShowBulkActions: !wire.entangle('hideBulkActionsWhenEmpty'),
        toggleSelectAll() {
            if (!showBulkActionsAlpine) {
                return;
            }

            if (this.paginationTotalItemCount === this.selectedItems.length) {
                this.clearSelected();
            } else {
                this.setAllSelected();
            }
        },
        setAllSelected() {
            if (!showBulkActionsAlpine) {
                return;
            }

            wire.setAllSelected();
        },
        clearSelected() {
            if (!showBulkActionsAlpine) {
                return;
            }

            wire.clearSelected();
        },
        selectAllOnPage() {
            if (!showBulkActionsAlpine) {
                return;
            }

            let tempSelectedItems = this.selectedItems;
            const iterator = this.paginationCurrentItems.values();
            for (const value of iterator) {
                tempSelectedItems.push(value.toString());
            }
            this.selectedItems = [...new Set(tempSelectedItems)];
        }
    }));

    Alpine.data('reorderFunction', (wire, tableID, primaryKeyName) => ({
        dragging: false,
        reorderEnabled: false,
        sourceID: '',
        targetID: '',
        evenRowClasses: '',
        oddRowClasses: '',
        currentlyHighlightedElement: '',
        evenRowClassArray: {},
        oddRowClassArray: {},
        evenNotInOdd: {},
        oddNotInEven: {},
        orderedRows: [],
        defaultReorderColumn: wire.entangle('defaultReorderColumn'),
        reorderStatus: wire.entangle('reorderStatus').live,
        currentlyReorderingStatus: wire.entangle('currentlyReorderingStatus'),
        hideReorderColumnUnlessReorderingStatus: wire.entangle('hideReorderColumnUnlessReorderingStatus'),
        reorderDisplayColumn: wire.entangle('reorderDisplayColumn'),
        reorderCurrentPageOnly: wire.entangle('reorderCurrentPageOnly'),
        dragStart(event) {
            this.sourceID = event.target.id;
            event.dataTransfer.effectAllowed = 'move';
            event.dataTransfer.setData('text/plain', event.target.id);
            event.target.classList.add("laravel-livewire-tables-dragging");
        },
        dragOverEvent(event) {
            if (typeof this.currentlyHighlightedElement == 'object') {
                this.currentlyHighlightedElement.classList.remove('laravel-livewire-tables-highlight-bottom', 'laravel-livewire-tables-highlight-top');
            }
            let target = event.target.closest('tr');
            this.currentlyHighlightedElement = target;

            if (event.offsetY < (target.getBoundingClientRect().height / 2)) {
                target.classList.add('laravel-livewire-tables-highlight-top');
                target.classList.remove('laravel-livewire-tables-highlight-bottom');
            }
            else {
                target.classList.remove('laravel-livewire-tables-highlight-top');
                target.classList.add('laravel-livewire-tables-highlight-bottom');
            }
        },
        dropEvent(event) {
            if (typeof this.currentlyHighlightedElement == 'object') {
                this.currentlyHighlightedElement.classList.remove('laravel-livewire-tables-highlight-bottom', 'laravel-livewire-tables-highlight-top');
            }

            let target = event.target.closest('tr');
            let parent = event.target.closest('tr').parentNode;
            let element = document.getElementById(this.sourceID).closest('tr');
            element.classList.remove("laravel-livewire-table-dragging");
            let originalPosition = element.rowIndex;
            let newPosition = target.rowIndex;
            let table = document.getElementById(tableID);
            let loopStart = originalPosition;
            if (event.offsetY > (target.getBoundingClientRect().height / 2)) {
                parent.insertBefore(element, target.nextSibling);
            }
            else {
                parent.insertBefore(element, target);
            }
            if (newPosition < originalPosition) {
                loopStart = newPosition;
            }
            let nextLoop = 'even';
            this.orderedRows = [];
            for (let i = 2, row; row = table.rows[i]; i++) {
                if (!row.classList.contains('hidden')) {
                    this.orderedRows.push({ [primaryKeyName]: row.getAttribute('rowpk'), [this.defaultReorderColumn]: i });
                    if (nextLoop === 'even') {
                        row.classList.remove(...this.oddNotInEven);
                        row.classList.add(...this.evenNotInOdd);
                        nextLoop = 'odd';
                    }
                    else {
                        row.classList.remove(...this.evenNotInOdd);
                        row.classList.add(...this.oddNotInEven);
                        nextLoop = 'even';
                    }
                }
            }
        },
        reorderToggle() {
            if (this.currentlyReorderingStatus) {
                this.cancelReorder();
            }
            else {
                this.currentlyReorderingStatus = true;
                if (this.hideReorderColumnUnlessReorderingStatus) {
                    this.reorderDisplayColumn = true;
                }
                if (!this.reorderCurrentPageOnly) {
                    wire.enableReordering();
                }
            }
        },
        cancelReorder() {
            this.currentlyReorderingStatus = false;
            if (this.hideReorderColumnUnlessReorderingStatus) {
                this.reorderDisplayColumn = false;
            }
            if (!this.reorderCurrentPageOnly) {
                wire.disableReordering();
            }
        },
        updateOrderedItems() {
            this.currentlyReorderingStatus = false;
            if (this.hideReorderColumnUnlessReorderingStatus) {
                this.reorderDisplayColumn = false;
            }
            wire.set('orderedItems', this.orderedRows);
            if (!this.reorderCurrentPageOnly) {
                wire.disableReordering();
            }
        },
        init() {
            let table = document.getElementById(tableID);
            let tbody = table.getElementsByTagName('tbody')[0];
            const evenRowClassArray = Array.from(tbody.rows[4].classList);
            const oddRowClassArray = Array.from(tbody.rows[6].classList);
            this.evenNotInOdd = evenRowClassArray.filter(element => !oddRowClassArray.includes(element));
            this.oddNotInEven = oddRowClassArray.filter(element => !evenRowClassArray.includes(element));
        }
    }));
});
