
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


    Alpine.data('reorderFunction', () => ({
        dragging: false,
        sourceID: '',
        targetID: '',
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
            const id = event.dataTransfer.getData('text/plain');
            const target = event.target.closest('tr');
            const parent = event.target.closest('tr').parentNode;
            const element = document.getElementById(id).closest('tr');
            parent.insertBefore(element, target.nextSibling);
            var table = target.closest('table');
            for (var i = 0, row; row = table.rows[i]; i++) {
                if (i % 2 === 0) {
                    row.classList.remove('dark:bg-gray-700');
                    row.classList.remove('bg-white');
                    row.classList.add('bg-gray-50');
                    row.classList.add('dark:bg-gray-800');

                }
                else {
                    row.classList.remove('dark:bg-gray-800');
                    row.classList.remove('bg-gray-50');
                    row.classList.add('bg-white');
                    row.classList.add('dark:bg-gray-700');

                }
            }

        }
    }));

});
