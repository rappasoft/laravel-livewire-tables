/*jshint esversion: 6 */

function tableReorder() {
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
        defaultReorderColumn: wire.get('defaultReorderColumn'),
        reorderStatus: wire.get('reorderStatus'),
        currentlyReorderingStatus: wire.entangle('currentlyReorderingStatus'),
        hideReorderColumnUnlessReorderingStatus: wire.entangle('hideReorderColumnUnlessReorderingStatus'),
        reorderDisplayColumn: wire.entangle('reorderDisplayColumn'),
        getReorderTable() {
            return Array.from(wire.$el.querySelectorAll('table')).find(table =>
                table.id === tableID && table.closest('[wire\\:id]') === wire.$el &&
                table.parentElement.closest('table')?.closest('[wire\\:id]') !== wire.$el
            );
        },
        getReorderRows() {
            let table = this.getReorderTable();
            return table ? Array.from(table.tBodies).flatMap(tbody =>
                Array.from(tbody.children).filter(row => row.tagName === 'TR' && row.hasAttribute('rowpk') && row.closest('[wire\\:id]') === wire.$el)
            ) : [];
        },
        dragStart(event) {
            this.sourceID = '';
            let row = event.target.closest('tr');
            if (!this.getReorderRows().includes(row)) {
                return;
            }
            this.$nextTick(() => { this.setupEvenOddClasses() });
            this.sourceID = row.id;
            event.dataTransfer.effectAllowed = 'move';
            event.dataTransfer.setData('text/plain', row.id);
            event.dataTransfer.setData('application/x-livewire-tables', JSON.stringify([wire.$el.getAttribute('wire:id'), tableID]));
            row.classList.add("laravel-livewire-tables-dragging");
        },
        dragOverEvent(event) {
            if (typeof this.currentlyHighlightedElement == 'object') {
                this.currentlyHighlightedElement.classList.remove('laravel-livewire-tables-highlight-bottom', 'laravel-livewire-tables-highlight-top');
            }
            let target = event.target.closest('tr');
            let rows = this.getReorderRows();
            if (!rows.some(row => row.id === this.sourceID) || !rows.includes(target)) {
                return;
            }
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
            let target = event.target.closest('tr');
            if (this.getReorderRows().includes(target)) {
                target.classList.remove('laravel-livewire-tables-highlight-bottom', 'laravel-livewire-tables-highlight-top');
            }
        },
        dropEvent(event) {
            if (typeof this.currentlyHighlightedElement == 'object') {
                this.currentlyHighlightedElement.classList.remove('laravel-livewire-tables-highlight-bottom', 'laravel-livewire-tables-highlight-top');
            }
            let rows = this.getReorderRows();
            let target = event.target.closest('tr');
            let element = rows.find(row => row.id === this.sourceID);
            this.sourceID = '';
            if (!element || !rows.includes(target) || event.dataTransfer.getData('application/x-livewire-tables') !== JSON.stringify([wire.$el.getAttribute('wire:id'), tableID])) {
                return;
            }
            element.classList.remove("laravel-livewire-tables-dragging");
            if (element === target) {
                return;
            }
            if (event.offsetY > (target.getBoundingClientRect().height / 2)) {
                target.parentNode.insertBefore(element, target.nextSibling);
            }
            else {
                target.parentNode.insertBefore(element, target);
            }
            let nextLoop = 'even';
            for (let row of this.getReorderRows()) {
                if (!row.classList.contains('hidden') && !row.classList.contains('md:hidden') ) {
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
            this.$nextTick(() => { this.setupEvenOddClasses() });
            if (this.currentlyReorderingStatus) {
                wire.disableReordering();

            }
            else {
                this.setupEvenOddClasses();
                if (this.hideReorderColumnUnlessReorderingStatus) {
                    this.reorderDisplayColumn = true;
                }
                wire.enableReordering();

            }
        },
        cancelReorder() {
            if (this.hideReorderColumnUnlessReorderingStatus) {
                this.reorderDisplayColumn = false;
            }
            wire.disableReordering();

        },
        updateOrderedItems() {
            if (!this.getReorderTable()) {
                return;
            }
            let orderedRows = this.getReorderRows().map((row, index) => ({
                [primaryKeyName]: row.getAttribute('rowpk'), [this.defaultReorderColumn]: index + 1
            }));
            wire.storeReorder(orderedRows);
        },
        setupEvenOddClasses() {
            if (this.evenNotInOdd.length === undefined || this.evenNotInOdd.length == 0 || this.oddNotInEven.length === undefined || this.oddNotInEven.length == 0)
            {
                let rows = this.getReorderRows();
                if (rows[0] !== undefined && rows[1] !== undefined) {
                    let evenRowClassArray = Array.from(rows[0].classList);
                    let oddRowClassArray = Array.from(rows[1].classList);
                    this.evenNotInOdd = evenRowClassArray.filter(element => !oddRowClassArray.includes(element));
                    this.oddNotInEven = oddRowClassArray.filter(element => !evenRowClassArray.includes(element));
                }
            }
        },
        init() {
        }
    }));
}
   export default tableReorder;
