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
        dragStart(event) {
            this.$nextTick(() => { this.setupEvenOddClasses() });


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
            for (let i = 1, row; row = table.rows[i]; i++) {
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
            let table = document.getElementById(tableID);
            let orderedRows = [];
            for (let i = 1, row; row = table.rows[i]; i++) {
            orderedRows.push({ [primaryKeyName]: row.getAttribute('rowpk'), [this.defaultReorderColumn]: i });
            }
            wire.storeReorder(orderedRows);
        },
        setupEvenOddClasses() {
            if (this.evenNotInOdd.length === undefined || this.evenNotInOdd.length == 0 || this.oddNotInEven.length === undefined || this.oddNotInEven.length == 0)
            {
                let tbody = document.getElementById(tableID).getElementsByTagName('tbody')[0];
                let evenRowClassArray = [];
                let oddRowClassArray = [];
 
                if (tbody.rows[0] !== undefined && tbody.rows[1] !== undefined) {
                    evenRowClassArray = Array.from(tbody.rows[0].classList);
                    oddRowClassArray = Array.from(tbody.rows[1].classList);
                    this.evenNotInOdd = evenRowClassArray.filter(element => !oddRowClassArray.includes(element));
                    this.oddNotInEven = oddRowClassArray.filter(element => !evenRowClassArray.includes(element));

                    evenRowClassArray = []
                    oddRowClassArray = []
                }
            }
        },
        init() {
        }
    }));
}
   export default tableReorder;