<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Attributes;

final class AggregateColumnProvider
{
    public static function relationshipProvider(): array
    {
        return [
            ['users', 'age'],
        ];
    }
}
