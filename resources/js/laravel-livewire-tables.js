/*jshint esversion: 6 */

document.addEventListener('alpine:init', () => {
    
    Alpine.data('laravellivewiretable', (wire) => ({
        tableId: '',
        showBulkActionsAlpine: false,
        primaryKeyName: '',
        shouldBeDisplayed: wire.entangle('shouldBeDisplayed'),
        tableName: wire.entangle('tableName'),
        dataTableFingerprint: wire.entangle('dataTableFingerprint'),
        listeners: [],
        childElementOpen: false,
        filtersOpen: wire.entangle('filterSlideDownDefaultVisible'),
        paginationCurrentCount: wire.entangle('paginationCurrentCount'),
        paginationTotalItemCount: wire.entangle('paginationTotalItemCount'),
        paginationCurrentItems: wire.entangle('paginationCurrentItems'),
        selectedItems: wire.entangle('selected'),
        selectAllStatus: wire.entangle('selectAll'),
        delaySelectAll: wire.entangle('delaySelectAll'),
        hideBulkActionsWhenEmpty: wire.entangle('hideBulkActionsWhenEmpty'),
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
        externalFilterPillsVals: wire.entangle('externalFilterPillsValues'),
        internalFilterPillsVals: wire.entangle('internalFilterPillsVals'),
        showFilterPillLabel: [],
        filterPillsSeparator: ', ',
        showFilterPillsSection: true,
        resetSpecificFilter(filterKey)
        {
            this.externalFilterPillsVals[filterKey] = [];
            wire.call('resetFilter',filterKey);
        },
        resetAllFilters()
        {
            this.externalFilterPillsVals = [];
            wire.call('setFilterDefaults');
        },
        setInternalFilterPillVal(filterKey, filterValues)
        {
            console.log('setInternalFilterPillVal');
            console.log('filterKey:'+filterKey);
            console.log('filterValues:'+filterValues);

            if(typeof(filterValues) !== 'undefined')
            {
                this.internalFilterPillsVals[filterKey] = filterValues;
            }
        },
        syncExternalFilterPillsValues(filterKey,filterValues) {
            this.externalFilterPillsVals[filterKey] = filterValues;
            this.showFilterPillLabel[filterKey] = this.getFilterPillsLength(filterKey);
        },
        getFilterPillsLength(filterKey)
        {
            return Object.keys(this.externalFilterPillsVals[filterKey]).length ?? 0;
        },
        showFilterPillsValue(filterKey, filterPillValue)
        {
            if(typeof(filterPillValue) !== "undefined")
            {
                this.externalFilterPillsVals[filterKey] = filterPillValue;
            }
            else
            {
                this.externalFilterPillsVals[filterKey] = null;
            }
            
        },
        setFilterPillsLength(externalFilterPillsValues)
        {
            let filterValueLength = 0;
            if (typeof(externalFilterPillsValues) !== 'undefined')
            {
                filterValueLength = Object.keys(externalFilterPillsValues).length ?? 0;
            }
            else
            {
                filterValueLength = 0;
            }
            return filterValueLength; 
        },
        showFilterPillsLabel(filterKey)
        {
            let pillsLength = this.getFilterPillsLength(filterKey);
            return (this.getFilterPillsLength(filterKey) > 0);
        },
        getFilterPillImplodedValues(filterKey, separator)
        {
            let filterPillValues = this.externalFilterPillsVals[filterKey];
            if(filterPillValues !== 'undefined')
            {
                console.log("filterPillValues Are Defined");
                let joinedValues = filterPillValues.join(separator);
                console.log("joinedValues");
                console.log(joinedValues);

                return joinedValues;
            }
            console.log("filterPillValues Are Not Defined");

            return '';
        },
        showFilterPillsSeparator(filterKey,index)
        {
            return ((index+1) < (this.getFilterPillsLength(filterKey)));
        },
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
            let table = document.getElementById(this.tableId);
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
            if (this.currentlyReorderingStatus) {
                wire.disableReordering();
            }
            else {
                if (this.hideReorderColumnUnlessReorderingStatus) {
                    this.reorderDisplayColumn = true;
                }
                this.setupEvenOddClasses();
                wire.enableReordering();
            }
            this.$nextTick(() => { this.setupEvenOddClasses() });
        },
        cancelReorder() {
            if (this.hideReorderColumnUnlessReorderingStatus) {
                this.reorderDisplayColumn = false;
            }

            wire.disableReordering();
 
        },
        updateOrderedItems() {
            let table = document.getElementById(this.tableId);
            let orderedRows = [];
            for (let i = 1, row; row = table.rows[i]; i++) {
            orderedRows.push({ [this.primaryKeyName]: row.getAttribute('rowpk'), [this.defaultReorderColumn]: i });
            }
            wire.storeReorder(orderedRows);
        },
        setupEvenOddClasses() {
            if (this.evenNotInOdd.length === undefined || this.evenNotInOdd.length == 0 || this.oddNotInEven.length === undefined || this.oddNotInEven.length == 0)
            {
                let tbody = document.getElementById(this.tableId).getElementsByTagName('tbody')[0];
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
        toggleSelectAll() {
            if (!this.showBulkActionsAlpine) {
                return;
            }

            if (this.paginationTotalItemCount === this.selectedItems.length) {
                this.clearSelected();
                this.selectAllStatus = false;
            } else {
                if (this.delaySelectAll)
                {   
                    this.setAllItemsSelected();
                }
                else
                {
                    this.setAllSelected();
                }
            }
        },
        setAllItemsSelected() {
            if (!this.showBulkActionsAlpine) {
                return;
            }
            this.selectAllStatus = true;
            this.selectAllOnPage();
        },
        setAllSelected() {
            if (!this.showBulkActionsAlpine) {
                return;
            }
            if (this.delaySelectAll)
            {   
                this.selectAllStatus = true;
                this.selectAllOnPage();
            }
            else
            {
                wire.setAllSelected();
            }
        },
        clearSelected() {
            if (!this.showBulkActionsAlpine) {
                return;
            }
            this.selectAllStatus = false;
            wire.clearSelected();
        },
        selectAllOnPage() {
            if (!this.showBulkActionsAlpine) {
                return;
            }

            let tempSelectedItems = this.selectedItems;
            const iterator = this.paginationCurrentItems.values();
            for (const value of iterator) {
                tempSelectedItems.push(value.toString());
            }
            this.selectedItems = [...new Set(tempSelectedItems)];
        },
        setTableId(tableId)
        {
            this.tableId = tableId;
        },
        setAlpineBulkActions(showBulkActionsAlpine)
        {
            this.showBulkActionsAlpine = showBulkActionsAlpine;
        },
        setPrimaryKeyName(primaryKeyName)
        {
            this.primaryKeyName = primaryKeyName;
        },
        showTable(event)
        {
            let eventTableName = event.detail.tableName ?? '';
            let eventTableFingerprint = event.detail.tableFingerpint ?? '';

            if (((eventTableName ?? '') != '' && eventTableName === this.tableName) || (eventTableFingerprint != '' && eventTableFingerpint === this.dataTableFingerprint)) { 
                this.shouldBeDisplayed = true; 
            } 
        },
        hideTable(event)
        {
            let eventTableName = event.detail.tableName ?? '';
            let eventTableFingerprint = event.detail.tableFingerpint ?? '';

            if ((eventTableName != '' && eventTableName === this.tableName) || (eventTableFingerprint != '' && eventTableFingerpint === this.dataTableFingerprint)) { 
                this.shouldBeDisplayed = false; 
            } 
        },
        destroy() {
            this.listeners.forEach((listener) => {
                listener();
            });
        },
    }));

    Alpine.data('booleanFilter', (wire,filterKey,tableName,defaultValue) => ({
        switchOn: false, 
        value: wire.entangle('filterComponents.'+filterKey).live, 
        init() { 
            this.switchOn = false; 
            if (typeof this.value !== 'undefined') { 
                this.switchOn = Boolean(Number(this.value)); 
            }
            this.listeners.push(
                Livewire.on('filter-was-set', (detail) => {
                    if(detail.tableName == tableName && detail.filterKey == filterKey) { 
                        this.switchOn = detail.value ?? defaultValue; 
                    }
                })
            );
        }
    }));

    Alpine.data('newBooleanFilter', (filterKey,tableName,defaultValue) => ({
        switchOn: false, 
        value: false, 
        toggleStatus()
        {
            let tempValue = Boolean(Number(this.$wire.get('filterComponents.'+filterKey) ?? this.value));
            let newBoolean = !tempValue;
            this.switchOn = this.value = newBoolean;
            return Number(newBoolean);
        },
        toggleStatusWithUpdate()
        {
            let newValue = this.toggleStatus();
            this.$wire.set('filterComponents.'+filterKey, newValue);
        },
        toggleStatusWithReset()
        {
            let newValue = this.toggleStatus();
            this.$wire.call('resetFilter',filterKey);
        },
        setSwitchOn(val)
        {
            let number = Number(val ?? 0);
            this.switchOn = Boolean(number); 
        },
        init() { 
            this.$nextTick(() => { 
                this.value = this.$wire.get('filterComponents.'+filterKey) ?? defaultValue;
                this.setSwitchOn(this.value ?? 0);
            });

            this.listeners.push(
                Livewire.on('filter-was-set', (detail) => {
                    if(detail.tableName == tableName && detail.filterKey == filterKey) { 
                        this.switchOn = detail.value ?? defaultValue; 
                    }
                })
            );
        }
    }));

    Alpine.data('numberRangeFilter', (wire, filterKey, parentElementPath, filterConfig, childElementRoot) => ({
        allFilters: wire.entangle('filterComponents', false),
        originalMin: 0,
        originalMax: 100,
        filterMin: 0,
        filterMax: 100,
        currentMin: 0,
        currentMax: 100,
        hasUpdate: false,
        wireValues: wire.entangle('filterComponents.' + filterKey, false),
        defaultMin: filterConfig['minRange'],
        defaultMax: filterConfig['maxRange'],
        restrictUpdates: false,
        initialiseStyles()
        {
            let numRangeFilterContainer = document.getElementById(parentElementPath);
            numRangeFilterContainer.style.setProperty('--value-a', this.wireValues['min'] ?? this.filterMin);
            numRangeFilterContainer.style.setProperty('--text-value-a', JSON.stringify(this.wireValues['min'] ?? this.filterMin));
            numRangeFilterContainer.style.setProperty('--value-b', this.wireValues['max'] ?? this.filterMax);
            numRangeFilterContainer.style.setProperty('--text-value-b', JSON.stringify(this.wireValues['max'] ?? this.filterMax));
        },
        updateStyles(filterMin, filterMax) {
            let numRangeFilterContainer = document.getElementById(parentElementPath);
            numRangeFilterContainer.style.setProperty('--value-a', filterMin);
            numRangeFilterContainer.style.setProperty('--text-value-a', JSON.stringify(filterMin));
            numRangeFilterContainer.style.setProperty('--value-b', filterMax);
            numRangeFilterContainer.style.setProperty('--text-value-b', JSON.stringify(filterMax));
        },
        setupWire() {
            if (this.wireValues !== undefined) {
                this.filterMin = this.originalMin = (this.wireValues['min'] !== undefined) ? this.wireValues['min'] : this.defaultMin;
                this.filterMax = this.originalMax = (this.wireValues['max'] !== undefined) ? this.wireValues['max'] : this.defaultMax;
            } else {
                this.filterMin = this.originalMin = this.defaultMin;
                this.filterMax = this.originalMax = this.defaultMax;
            }
            this.updateStyles(this.filterMin, this.filterMax);
        },
        allowUpdates() {
            this.updateWire();
        },
        updateWire() {
            let tmpFilterMin = parseInt(this.filterMin);
            let tmpFilterMax = parseInt(this.filterMax);
    
            if (tmpFilterMin != this.originalMin || tmpFilterMax != this.originalMax) {
                if (tmpFilterMax < tmpFilterMin) {
                    this.filterMin = tmpFilterMax;
                    this.filterMax = tmpFilterMin;
                }
                this.hasUpdate = true;
                this.originalMin = tmpFilterMin;
                this.originalMax = tmpFilterMax;
            }
            this.updateStyles(this.filterMin,this.filterMax);
        },
        updateWireable() {
            if (this.hasUpdate) {
                this.hasUpdate = false;
                this.wireValues = { 'min': this.filterMin, 'max': this.filterMax };
                wire.set('filterComponents.' + filterKey, this.wireValues);
            }
        },
        init() {
            this.initialiseStyles();
            this.setupWire();
            this.$watch('allFilters', value => this.setupWire());
        },
    }));
    
    Alpine.data('flatpickrFilter', (wire, filterKey, filterConfig, refLocation, locale) => ({
        wireValues: wire.entangle('filterComponents.' + filterKey),
        flatpickrInstance: flatpickr(refLocation, {
            mode: 'range',
            altFormat: filterConfig['altFormat'] ?? "F j, Y",
            altInput: filterConfig['altInput'] ?? false,
            allowInput: filterConfig['allowInput'] ?? false,
            allowInvalidPreload: filterConfig['allowInvalidPreload'] ?? true,
            ariaDateFormat: filterConfig['ariaDateFormat'] ?? "F j, Y",
            clickOpens: true,
            dateFormat: filterConfig['dateFormat'] ?? "Y-m-d",
            defaultDate: filterConfig['defaultDate'] ?? null,
            defaultHour: filterConfig['defaultHour'] ?? 12,
            defaultMinute: filterConfig['defaultMinute'] ?? 0,
            enableTime: filterConfig['enableTime'] ?? false,
            enableSeconds: filterConfig['enableSeconds'] ?? false,
            hourIncrement: filterConfig['hourIncrement'] ?? 1,
            locale: filterConfig['locale'] ?? 'en',
            minDate: filterConfig['earliestDate'] ?? null,
            maxDate: filterConfig['latestDate'] ?? null,
            minuteIncrement: filterConfig['minuteIncrement'] ?? 5,
            shorthandCurrentMonth: filterConfig['shorthandCurrentMonth'] ?? false,
            time_24hr: filterConfig['time_24hr'] ?? false,
            weekNumbers: filterConfig['weekNumbers'] ?? false,
            onOpen: function () {
                window.childElementOpen = true;
            },
            onChange: function (selectedDates, dateStr, instance) {
                if (selectedDates.length > 1) {
                    var dates = dateStr.split(' ');
                    var wireDateArray = {};
                    window.childElementOpen = false;
                    window.filterPopoverOpen = false;
                    wireDateArray = { 'minDate': dates[0], 'maxDate': (typeof dates[2] === "undefined") ? dates[0] : dates[2] };
                    wire.set('filterComponents.' + filterKey, wireDateArray);
                }
            },
        }),
        changedValue: function(value) {
            if (value.length < 5)
            {
                this.flatpickrInstance.setDate([]);   
                wire.set('filterComponents.' + filterKey, {});
            }
        },
        setupWire() {
            if (this.wireValues !== undefined) {
                if (this.wireValues.minDate !== undefined && this.wireValues.maxDate !== undefined) {
                    let initialDateArray = [this.wireValues.minDate, this.wireValues.maxDate];
                    this.flatpickrInstance.setDate(initialDateArray);
                }
                else {
                    this.flatpickrInstance.setDate([]);
                }
            }
            else {
                this.flatpickrInstance.setDate([]);
            }
        },
        init() {
            this.setupWire();
            this.$watch('wireValues', value => this.setupWire());
        }
    
    
    }));

    Alpine.data('tableWrapper', (wire, showBulkActionsAlpine) => ({
        shouldBeDisplayed: wire.entangle('shouldBeDisplayed'),
        listeners: [],
        childElementOpen: false,
        filtersOpen: wire.entangle('filterSlideDownDefaultVisible'),
        paginationCurrentCount: wire.entangle('paginationCurrentCount'),
        paginationTotalItemCount: wire.entangle('paginationTotalItemCount'),
        paginationCurrentItems: wire.entangle('paginationCurrentItems'),
        selectedItems: wire.entangle('selected'),
        selectAllStatus: wire.entangle('selectAll'),
        delaySelectAll: wire.entangle('delaySelectAll'),
        hideBulkActionsWhenEmpty: wire.entangle('hideBulkActionsWhenEmpty'),
        toggleSelectAll() {
            if (!showBulkActionsAlpine) {
                return;
            }

            if (this.paginationTotalItemCount === this.selectedItems.length) {
                this.clearSelected();
                this.selectAllStatus = false;
            } else {
                if (this.delaySelectAll)
                {   
                    this.setAllItemsSelected();
                }
                else
                {
                    this.setAllSelected();
                }
            }
        },
        setAllItemsSelected() {
            if (!showBulkActionsAlpine) {
                return;
            }
            this.selectAllStatus = true;
            this.selectAllOnPage();
        },
        setAllSelected() {
            if (!showBulkActionsAlpine) {
                return;
            }
            if (this.delaySelectAll)
            {   
                this.selectAllStatus = true;
                this.selectAllOnPage();
            }
            else
            {
                wire.setAllSelected();
            }
        },
        clearSelected() {
            if (!showBulkActionsAlpine) {
                return;
            }
            this.selectAllStatus = false;
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
        destroy() {
            this.listeners.forEach((listener) => {
                listener();
            });
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

    Alpine.data('filterPillsGeneric', (localFilterKey, localFilterPillsSeparator, shouldWatch) => ({
        localFilterKey: localFilterKey,
        localFilterPillsSeparator: localFilterPillsSeparator,
        localFilterPillValues: '',
        localShouldWatch: Boolean(shouldWatch),
        localHasValues: true,
        updateHasValues()
        {
            this.localHasValues = (this.localFilterPillValues.length > 0);
        },
        updateLocalFilterPillImplodedValues(filterPillValues)
        {
            if(typeof(filterPillValues) !== 'undefined')
            {
                if(Array.isArray(filterPillValues))
                {
                    let joinedValues = filterPillValues.join(this.localFilterPillsSeparator);
                    return joinedValues;
                }
                else
                {
                    return filterPillValues;
                }
            }
            return "";
        },
        getLocalFilterPillImplodedValues()
        {
            let filterPillValues = this.externalFilterPillsVals[this.localFilterKey];
            return this.updateLocalFilterPillImplodedValues(filterPillValues);
        },
        init()
        {
            this.$nextTick(() => { 
                this.localFilterPillValues = this.getLocalFilterPillImplodedValues(); 
                this.updateHasValues();
            });
            if(this.localShouldWatch)
            {
                this.$watch('externalFilterPillsVals.'+this.localFilterKey, filterPillValues => { 
                    console.log('filterPillsGeneric - externalFilterPillsVals - changed');
                    this.localFilterPillValues = this.updateLocalFilterPillImplodedValues(filterPillValues); 
                    this.updateHasValues();
                });      
            }
        }
    }));

    Alpine.data('filterPillsArrayExternalNew', (wire, filterKey) => ({
        externalFilterKey: filterKey,
        pillValues: [],
        optionsAvailable: wire.entangle('optionsAvailable'), 
        optionsSelected: wire.entangle('optionsSelected').live, 
        selectedItems: [], 
        syncItems(items) { 
            this.pillValues = [];
            items.forEach((item) => {
                this.pillValues.push(this.optionsAvailable[item]);
            });
            if(this.pillValues.length > 0)
            {
                this.pillValues.sort();
                this.syncExternalFilterPillsValues(this.externalFilterKey,this.pillValues);
            }
            this.optionsSelected = this.selectedItems;
            wire.set('value', this.selectedItems);

        }, 
        init() { 
            this.selectedItems = this.optionsSelected;
            this.syncItems(this.selectedItems);
            this.$watch('selectedItems', value => this.syncItems(value)); 
        } 

    }));

    Alpine.data('filterPillsArrayExternal', (tableNameVal, filterKeyVal) => ({
        tableName: tableNameVal,
        filterKey: filterKeyVal,
        filterPillValues: null,
        separator: ', ',
        filterPillValuesLength: 0,
        hasLoaded: false,
        updatedPillsValues(event)
        {
            console.log("filterPillsArrayExternal - updatedPillsValues");
            this.hasLoaded = false;
            let eventTableName = event.detail.tableName ?? '';
            let eventFilterValues = event.detail.filterValues;
            let eventFilterValueLength = 0;
            if((eventTableName ?? '') != '' && eventTableName === this.tableName)
            {
                this.filterPillValues = eventFilterValues; 
                eventFilterValueLength = this.setLength(eventFilterValues);

                this.filterPillValuesLength = eventFilterValueLength;
            }
            this.hasLoaded = true;
        },
        refreshFilterPill(event)
        {
            console.log("filterPillsArrayExternal - refreshFilterPill");

        },
        refreshFilterPillNew(event)
        {
            console.log("filterPillsArrayExternal - refreshFilterPillNew");

            let eventFilterValues = event.detail.filterValues;

            this.filterPillValues = eventFilterValues;
            this.filterPillValuesLength = (typeof(eventFilterValues) !== 'undefined') ? Object.keys(eventFilterValues).length  : 0;

        },
        setupFilterPill(separator, filterPillValues)
        {
            this.hasLoaded = false;

            this.separator = separator;
            this.filterPillValues = filterPillValues;
            this.filterPillValuesLength = (typeof(this.filterPillValues) !== 'undefined') ? Object.keys(this.filterPillValues).length  : 0;
            this.$nextTick(() => { 
                this.filterPillValuesLength = (typeof(this.filterPillValues) !== 'undefined') ? Object.keys(this.filterPillValues).length  : 0 
                this.hasLoaded = true;

            });

        },
        setSeparator(value)
        {
            this.separator = value;
        },
        getLength()
        {
            return Object.keys(this.filterPillValues).length ?? 0;
        },
        setLength(eventFilterValues)
        {
            let filterValueLength = 0;
            if (typeof(eventFilterValues) !== 'undefined')
            {
                filterValueLength = Object.keys(eventFilterValues).length ?? 0;
            }
            else
            {
                filterValueLength = 0;
            }
            return filterValueLength; 
        },
        showSeparator(index)
        {
            return ((index+1) < (this.getLength()));
        },
        init()
        {
            window.addEventListener('filter-pills-updated', (event) => {
                this.updatedPillsValues(event)
            });

            window.addEventListener('update-filter-pill-values', (event) => {
                this.refreshFilterPill(event)
            });
            window.addEventListener('refresh-filter-pill', (event) => {
                this.refreshFilterPillNew(event);
            });

            
        }
    }));


});