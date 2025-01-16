<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals\Filters;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\BreedsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

#[Group('Visuals')]
#[Group('Filters')]
final class TextFilterVisualsTest extends FilterVisualsTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
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
                        ->setFieldName('name')
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
                        ->setFieldName('name')
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
                        ->setFieldName('name')
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
                        ->setFieldName('name')
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
                        ->setFieldName('name')
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
                        ->setFieldName('name')
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

    public function test_can_set_custom_attributes_on_text_filter(): void
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
                        ->setInputAttributes(['maxlength' => 75, 'class' => 'bg-red-500', 'default-styling' => true]),
                ];
            }
        })
            ->assertSeeHtml('<input wire:model.blur="filterComponents.name" class="block w-full rounded-md shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50 bg-red-500" id="table-filter-name" maxlength="75" type="text" wire:key="table-filter-text-name" />');

    }
}
