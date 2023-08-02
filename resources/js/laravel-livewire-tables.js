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
        reorderStatus: wire.entangle('reorderStatus'),
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
        dragLeaveEvent(event) {
            event.target.closest('tr').classList.remove('laravel-livewire-tables-highlight-bottom', 'laravel-livewire-tables-highlight-top');

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

            /* 
            let evenList = parentNode.querySelectorAll("table[tableType='rappasoft-laravel-livewire-tables']>tbody>tr:nth-child(even of tr.rappasoft-striped-row) ").forEach(function (elem) {
                elem.classList.remove(...this.oddNotInEven);
                row.classList.add(...this.evenNotInOdd);
            });
            */
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
                    wire.enablePaginatedReordering();
                }
            }
        },
        cancelReorder() {
            this.currentlyReorderingStatus = false;
            if (this.hideReorderColumnUnlessReorderingStatus) {
                this.reorderDisplayColumn = false;
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

    Alpine.data('numberRangeFilter', (wire, filterKey, parentElementPath, filterConfig) => ({
        allFilters: wire.entangle('filterComponents', true),
        originalMin: 0,
        originalMax: 100,
        filterMin: 0,
        filterMax: 100,
        currentMin: 0,
        currentMax: 100,
        hasUpdate: false,
        wireValues: wire.entangle('filterComponents.' + filterKey, true),
        defaultMin: filterConfig['minRange'],
        defaultMax: filterConfig['maxRange'],
        restrictUpdates: false,
        updateStyles() {
            let numRangeFilterContainer = document.getElementById(parentElementPath);
            numRangeFilterContainer.style.setProperty('--value-a', this.filterMin);
            numRangeFilterContainer.style.setProperty('--text-value-a', JSON.stringify(this.filterMin));
            numRangeFilterContainer.style.setProperty('--value-b', this.filterMax);
            numRangeFilterContainer.style.setProperty('--text-value-b', JSON.stringify(this.filterMax));
        },
        setupWire() {
            if (this.wireValues !== undefined) {
                this.filterMin = this.originalMin = (this.wireValues['min'] !== undefined) ? this.wireValues['min'] : this.defaultMin;
                this.filterMax = this.originalMax = (this.wireValues['max'] !== undefined) ? this.wireValues['max'] : this.defaultMax;
            } else {
                this.filterMin = this.originalMin = this.defaultMin;
                this.filterMax = this.originalMax = this.defaultMax;
            }
            this.updateStyles();
        },
        allowUpdates() {
            this.updateWire();
        },
        updateWire() {
            this.filterMin = parseInt(this.filterMin);
            this.filterMax = parseInt(this.filterMax);

            if (this.filterMin != this.originalMin || this.filterMax != this.originalMax) {
                if (this.filterMax < this.filterMin) {
                    let tempMin = this.filterMin;
                    this.filterMin = this.filterMax;
                    this.filterMax = tempMin;
                }
                this.hasUpdate = true;
                this.originalMin = this.filterMin;
                this.originalMax = this.filterMax;
                this.updateStyles();
            }
        },
        updateWireable() {
            if (this.hasUpdate) {
                this.hasUpdate = false;
                this.wireValues = { 'min': this.filterMin, 'max': this.filterMax };
            }

        },
        init() {
            this.setupWire();
            this.$watch('allFilters', value => this.setupWire());
        },
    }));
});
