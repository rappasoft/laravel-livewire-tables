@aware(['component', 'tableName'])
<div x-data
            x-show="reorderStatus"
            @class([
                'mr-0 mr-md-2 mb-3 mb-md-0' => $component->isBootstrap4(),
                'me-0 me-md-2 mb-3 mb-md-0' => $component->isBootstrap5()
            ])
        >
            <button
                x-on:click="reorderToggle"
                type="button"
                @class([
                    'btn btn-default d-block w-100 d-md-inline' => $component->isBootstrap(),
                ])
            >
                <span x-show="currentlyReorderingStatus">
                    @lang('Cancel')
                </span>

                <span x-show="!currentlyReorderingStatus">
                    @lang('Reorder')
                </span>

            </button>
        </div>
        <button
                type="button"
                x-show="reorderStatus && currentlyReorderingStatus" 
                x-on:click="updateOrderedItems"
                :class="(reorderStatus && currentlyReorderingStatus) ? 'btn btn-default d-block w-100 d-md-inline' : 'hidden'"
            >
                    @lang('Save')
        </button>
