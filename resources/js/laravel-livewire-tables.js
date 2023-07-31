
document.addEventListener('alpine:init', () => {
    Alpine.data('tableWrapper', (wire, showBulkActionsAlpine) => ({
        filtersOpen: wire.entangle('filterSlideDownDefaultVisible'),
        paginationCurrentCount: wire.entangle('paginationCurrentCount').live,
        paginationTotalItemCount: wire.entangle('paginationTotalItemCount').live,
        paginationCurrentItems: wire.entangle('paginationCurrentItems').live,
        selectedItems: wire.entangle('selected'),
        alwaysShowBulkActions: !wire.entangle('hideBulkActionsWhenEmpty'),
        reorderStatus: wire.entangle('reorderStatus').live,
        reorderCurrentStatus: wire.entangle('currentlyReorderingStatus'),
        reorderHideColumnUnlessReordering: wire.entangle('hideReorderColumnUnlessReorderingStatus'),
        reorderDisplayColumn: false,
        toggleSelectAll() {
            if (!showBulkActionsAlpine) {
                return;
            }

            if (this.paginationTotalItemCount == this.selectedItems.length) {
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
        },
        reorderToggle() {
            this.reorderCurrentStatus = !this.reorderCurrentStatus;
            this.reorderDisplayColumn = !this.reorderDisplayColumn;
        },
        init() {
            if (this.reorderCurrentStatus) {
                this.reorderDisplayColumn = true;
            }
            else if (!this.reorderHideColumnUnlessReordering) {
                this.reorderDisplayColumn = true;
            }
        }

    }));


    Alpine.data('reorderFunction', (wire, tableID) => ({
        dragging: false,
        sourceID: '',
        targetID: '',
        evenRowClasses: '',
        oddRowClasses: '',
        evenRowClassArray: {},
        oddRowClassArray: {},
        evenNotInOdd: {},
        oddNotInEven: {},
        orderedRows: [],
        dragStart(event) {
            dragging = true;
            sourceID = event.target.id;
            event.dataTransfer.effectAllowed = 'move';
            event.dataTransfer.setData('text/plain', event.target.id);
        },
        dropEvent() {
            removing = false
        },
        dropPreventEvent(event) {
            var id = event.dataTransfer.getData('text/plain');
            var target = event.target.closest('tr');
            var parent = event.target.closest('tr').parentNode;
            var element = document.getElementById(id).closest('tr');
            var originalPosition = element.rowIndex;
            var newPosition = target.rowIndex;
            var table = document.getElementById(tableID);
            var loopStart = originalPosition;
            if (newPosition < originalPosition) {
                loopStart = newPosition;
            }
            parent.insertBefore(element, target.nextSibling);
            var nextLoop = 'even';
            this.orderedRows = [];
            for (var i = 2, row; row = table.rows[i]; i++) {
                if (!row.classList.contains('hidden')) {
                    this.orderedRows.push(row.getAttribute('rowpk'));
                    if (nextLoop == 'even') {
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
        updateOrderedItems() {
            wire.set('orderedItems', this.orderedRows);
        },
        init() {
            var table = document.getElementById(tableID);
            var tbody = table.getElementsByTagName('tbody')[0];
            const evenRowClassArray = Array.from(tbody.rows[4].classList);
            const oddRowClassArray = Array.from(tbody.rows[6].classList);
            this.evenNotInOdd = evenRowClassArray.filter(element => !oddRowClassArray.includes(element));
            this.oddNotInEven = oddRowClassArray.filter(element => !evenRowClassArray.includes(element));

        }
    }));

});
