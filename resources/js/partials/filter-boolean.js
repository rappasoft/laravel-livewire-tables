document.addEventListener('alpine:init', () => {
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
});