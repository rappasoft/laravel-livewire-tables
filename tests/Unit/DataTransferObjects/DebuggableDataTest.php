<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\DataTransferObjects;

use Rappasoft\LaravelLivewireTables\DataTransferObjects\DebuggableData;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class DebuggableDataTest extends TestCase
{
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_example2()
    {
        $this->assertSame($this->basicTable->sortBy('id'), 'asc');
    }

    public function test_check_all_default_dto_elements()
    {
        $this->basicTable->getRows();
        $debuggableDTO = new DebuggableData($this->basicTable);
        $debuggableArray = $debuggableDTO->toArray();

        $defaultQuery = 'select "pets"."id" as "id", "pets"."sort" as "sort", "pets"."name" as "name", "pets"."age" as "age", "breed"."name" as "breed.name", "pets"."last_visit" as "last_visit" from "pets" left join "breeds" as "breed" on "pets"."breed_id" = "breed"."id" limit 10 offset 0';
        $this->assertSame($debuggableArray['query'], $defaultQuery);
        $this->assertSame($debuggableArray['filters'], ['breed' => [],
            'species' => [],
            'breed_id_filter' => null,
            'pet_name_filter' => null,
            'last_visit_date_filter' => null,
            'last_visit_datetime_filter' => null,
            'breed_select_filter' => null]);
        $this->assertSame($debuggableArray['sorts'], []);
        $this->assertSame($debuggableArray['search'], '');
        $this->assertFalse($debuggableArray['select-all']);
        $this->assertSame($debuggableArray['selected'], []);
    }

    public function test_check_dto_returns_filters_correctly()
    {
        $debuggableDTO = new DebuggableData($this->basicTable);
        $debuggableArray = $debuggableDTO->toArray();
        $this->assertSame($debuggableArray['filters'], ['breed' => [],
            'species' => [],
            'breed_id_filter' => null,
            'pet_name_filter' => null,
            'last_visit_date_filter' => null,
            'last_visit_datetime_filter' => null,
            'breed_select_filter' => null]);

        $this->basicTable->setFilter('breed', ['1']);
        $debuggableDTO = new DebuggableData($this->basicTable);
        $debuggableArray = $debuggableDTO->toArray();
        $this->assertSame($debuggableArray['filters'], ['breed' => ['1'],
            'species' => [],
            'breed_id_filter' => null,
            'pet_name_filter' => null,
            'last_visit_date_filter' => null,
            'last_visit_datetime_filter' => null,
            'breed_select_filter' => null]);

    }
}
