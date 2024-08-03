<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals\Filters;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\BreedsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

final class TextFilterVisualsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        parent::setupBreedsTable();
    }

    public function test_can_use_endswith_method(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    TextFilter::make('name')
                        ->setField('name')
                        ->endsWith(),
                ];
            }
        })
            ->assertSee('Persian')
            ->call('setFilter', 'name', 'Coon')
            ->assertDontSee('Persian')
            ->assertSee('Coon');
    }

    public function test_can_use_ends_with_method_directly(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    TextFilter::make('name')
                        ->endsWith('name'),
                ];
            }
        })
            ->assertSee('Persian')
            ->call('setFilter', 'name', 'Coon')
            ->assertDontSee('Persian')
            ->assertSee('Coon');
    }

    public function test_can_use_not_ends_with_method(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    TextFilter::make('name')
                        ->setField('name')
                        ->notEndsWith(),
                ];
            }
        })
            ->assertSee('Maine Coon')
            ->call('setFilter', 'name', 'Coon')
            ->assertDontSee('Maine Coon')
            ->assertSee('Persian');
    }

    public function test_can_use_not_ends_with_method_directly(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    TextFilter::make('name')
                        ->notEndsWith('name'),
                ];
            }
        })
            ->assertSee('Maine Coon')
            ->call('setFilter', 'name', 'Coon')
            ->assertDontSee('Maine Coon')
            ->assertSee('Persian');
    }

    public function test_can_use_starts_with_method(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    TextFilter::make('name')
                        ->setField('name')
                        ->startsWith(),
                ];
            }
        })
            ->assertSee('Persian')
            ->call('setFilter', 'name', 'Maine')
            ->assertDontSee('Persian')
            ->assertSee('Maine Coon');
    }

    public function test_can_use_starts_with_method_directly(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    TextFilter::make('name')
                        ->startsWith('name'),
                ];
            }
        })
            ->assertSee('Persian')
            ->call('setFilter', 'name', 'Maine')
            ->assertDontSee('Persian')
            ->assertSee('Maine Coon');
    }

    public function test_can_use_not_starts_with_method(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    TextFilter::make('name')
                        ->setField('name')
                        ->notStartsWith(),
                ];
            }
        })
            ->assertSee('Maine Coon')
            ->call('setFilter', 'name', 'Maine')
            ->assertDontSee('Maine Coon')
            ->assertSee('Persian');
    }

    public function test_can_use_not_starts_with_method_directly(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    TextFilter::make('name')
                        ->notStartsWith('name'),
                ];
            }
        })
            ->assertSee('Maine Coon')
            ->call('setFilter', 'name', 'Maine')
            ->assertDontSee('Maine Coon')
            ->assertSee('Persian');
    }

    public function test_can_use_contains_method(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    TextFilter::make('name')
                        ->setField('name')
                        ->contains(),
                ];
            }
        })
            ->assertSee('Maine Coon')
            ->call('setFilter', 'name', 'ne')
            ->assertSee('Maine Coon')
            ->assertDontSee('Persian');
    }

    public function test_can_use_contains_method_directly(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    TextFilter::make('name')
                        ->contains('name'),
                ];
            }
        })
            ->assertSee('Maine Coon')
            ->call('setFilter', 'name', 'ne')
            ->assertSee('Maine Coon')
            ->assertDontSee('Persian');
    }

    public function test_can_use_not_contains_method(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    TextFilter::make('name')
                        ->setField('name')
                        ->notContains(),
                ];
            }
        })
            ->assertSee('Maine Coon')
            ->call('setFilter', 'name', 'e C')
            ->assertDontSee('Maine Coon')
            ->assertSee('Persian');
    }

    public function test_can_use_not_contains_method_directly(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    TextFilter::make('name')
                        ->notContains('name'),
                ];
            }
        })
            ->assertSee('Maine Coon')
            ->call('setFilter', 'name', 'e C')
            ->assertDontSee('Maine Coon')
            ->assertSee('Persian');
    }
}
