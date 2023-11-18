/*jshint esversion: 6 */

function fpf() {
    Alpine.data('flatpickrFilter', (wire, filterKey, filterConfig, refLocation, locale) => ({
    wireValues: wire.entangle('filterComponents.' + filterKey),
    flatpickrInstance: flatpickr(refLocation, {
        mode: 'range',
        clickOpens: true,
        allowInvalidPreload: true,
        defaultDate: [],
        ariaDateFormat: filterConfig['ariaDateFormat'],
        allowInput: filterConfig['allowInput'],
        altFormat: filterConfig['altFormat'],
        altInput: filterConfig['altInput'],
        dateFormat: filterConfig['dateFormat'],
        locale: 'en',
        minDate: filterConfig['earliestDate'],
        maxDate: filterConfig['latestDate'],
        onOpen: function () {
            window.childElementOpen = true;
        },
        onChange: function (selectedDates, dateStr, instance) {
            if (selectedDates.length > 1) {
                var startDate = dateStr.split(' ')[0];
                var endDate = dateStr.split(' ')[2];
                var wireDateArray = {};
                window.childElementOpen = false;
                window.filterPopoverOpen = false;
                wireDateArray = { 'minDate': startDate, 'maxDate': endDate };
                wire.set('filterComponents.' + filterKey, wireDateArray);
            }
        }
    }),
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
}

export default fpf;