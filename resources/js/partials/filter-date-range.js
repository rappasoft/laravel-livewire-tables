/*jshint esversion: 6 */

function fpf() {
    Alpine.data('flatpickrFilter', (wire, filterKey, filterConfig, refLocation, locale) => ({
        wireValues: wire.entangle('filterComponents.' + filterKey),
        flatpickrInstance: flatpickr(refLocation, {
            mode: 'range',
            altFormat: filterConfig['altFormat'] ?? "F j, Y",
            altInput: filterConfig['altInput'] ?? false,
            allowInput: filterConfig['allowInput'] ?? false,
            allowInvalidPreload: true,
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