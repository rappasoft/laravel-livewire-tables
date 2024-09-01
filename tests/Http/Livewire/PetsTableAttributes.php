<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

class PetsTableAttributes extends PetsTable
{
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTrAttributes(function ($row, $index) {
                if ($index === 0) {
                    return [
                        'testTrAttribute' => 'testTrAttributeValueForTestSuiteIndex0',
                        'default' => false,
                    ];
                }
                if ($index === 1) {
                    return [
                        'testTrAttribute' => 'testTrAttributeValueForTestSuiteIndex1',
                        'default' => false,
                    ];
                }
                if ($index === 500) {
                    return [
                        'testTrAttribute' => 'testTrAttributeValueForTestSuiteNotSeen',
                        'default' => false,
                    ];
                }

                return [];
            });

    }
}
