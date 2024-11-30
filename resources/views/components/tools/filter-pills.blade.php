@aware([ 'tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5'])

@if ($this->filtersAreEnabled() && $this->filterPillsAreEnabled() && $this->hasAppliedVisibleFiltersForPills())
    <div>
        <div @class([
            'mb-4 px-4 md:p-0' => $isTailwind,
            'mb-3' => $isBootstrap,
        ]) x-cloak x-show="!currentlyReorderingStatus">
            <small @class([
                'text-gray-700 dark:text-white' => $isTailwind,
                '' =>  $isBootstrap,
            ])>
                {{ __($this->getLocalisationPath.'Applied Filters') }}:
            </small>

            @foreach($this->getAppliedFiltersWithValues() as $filterSelectName => $value)
                @php($filter = $this->getFilterByKey($filterSelectName))
                @continue(is_null($filter) || $filter->isHiddenFromPills())
                @php( $filterPillTitle = $filter->getFilterPillTitle())
                @php( $filterPillValue = $filter->getFilterPillValue($value))
                @php( $separator = method_exists($filter, 'getPillsSeparator') ? $filter->getPillsSeparator() : ', ')
                @continue((is_array($filterPillValue) && empty($filterPillValue)))

                @if ($filter->hasCustomPillBlade())
                    @include($filter->getCustomPillBlade(), ['filter' => $filter])
                @else
                    <x-livewire-tables::tools.filter-pills.item :$filterPillTitle :$filterPillValue :$filterSelectName :$separator/>
                @endif
            @endforeach
            <x-livewire-tables::tools.filter-pills.buttons.reset-all />
        </div>
    </div>
@endif
