<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core;

use Livewire\Attributes\Computed;

trait HasLocalisations
{
    public string $localisationPathString = 'livewire-tables::core.';

    #[Computed]
    public function getLocalisationPath(): string
    {
        return $this->generateLocalisationPath();
    }

    public function generateLocalisationPath(): string
    {
        $this->localisationPathString = (config('livewire-tables.use_json_translations', false)) ? 'livewire-tables::' : 'livewire-tables::core.';

        return $this->localisationPathString;
    }
}
