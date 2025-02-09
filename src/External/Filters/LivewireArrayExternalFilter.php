<?php

namespace Rappasoft\LaravelLivewireTables\External\Filters;

use Livewire\Attributes\{Locked, Modelable, Renderless};
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\External\Filters\Traits\{HandlesCoreMethodsForExternalFilter,HandlesCorePropertiesForExternalFilter,HandlesTableEventsForExternalFilter, HandlesUpdateStatusForExternalFilter};

abstract class LivewireArrayExternalFilter extends Component
{
    use HandlesCoreMethodsForExternalFilter,
        HandlesCorePropertiesForExternalFilter,
        HandlesTableEventsForExternalFilter,
        HandlesUpdateStatusForExternalFilter;

    #[Modelable]
    public array $value = [];

    #[Locked]
    public array $optionsAvailable = [];

    public array $optionsSelected = [];

    public array $selectedItems = [];

    #[Renderless]
    public function updatedOptionsSelected(mixed $value): void
    {
        if (! $this->skipUpdate) {
            if (! $this->needsUpdating) {
                $this->needsUpdating = true;
            }
        }
    }
}
