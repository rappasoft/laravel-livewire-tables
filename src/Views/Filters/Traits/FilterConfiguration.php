<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

trait FilterConfiguration
{
    public function setGenericDisplayData(array $genericDisplayData = []): self
    {
        $this->genericDisplayData = [
            'filterLayout' => $genericDisplayData['filterLayout'],
            'tableName' => $genericDisplayData['tableName'],
            'isTailwind' => $genericDisplayData['isTailwind'],
            'isBootstrap' => ($genericDisplayData['isBootstrap4'] || $genericDisplayData['isBootstrap5']),
            'isBootstrap4' => $genericDisplayData['isBootstrap4'],
            'isBootstrap5' => $genericDisplayData['isBootstrap5'],
            'localisationPath' => $genericDisplayData['localisationPath'] ?? ((config('livewire-tables.use_json_translations', false)) ? 'livewire-tables::' : 'livewire-tables::core.'),

        ];

        return $this;
    }
}
