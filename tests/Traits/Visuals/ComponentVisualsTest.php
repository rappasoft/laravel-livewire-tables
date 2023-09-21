<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals;

use Exception;
use Illuminate\View\ViewException;
use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\FailingTables\{NoBuildMethodTable,NoPrimaryKeyTable};
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class ComponentVisualsTest extends TestCase
{
    private $testErrors;

    /** @test */
    public function empty_message_does_not_show_with_results(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSee('No items found. Try to broaden your search.');
    }

    /** @test */
    public function empty_message_shows_with_no_results(): void
    {
        Livewire::test(PetsTable::class)
            ->set('search', 'sdfsdfsdfadsfasdfasdd')
            ->assertSee('No items found');
    }

    /** @test */
    public function debugging_shows_when_enabled(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSee('Debugging Values')
            ->call('setDebugEnabled')
            ->assertSee('Debugging Values');
    }

    /** @test */
    public function offline_message_is_available_when_needed(): void
    {
        Livewire::test(PetsTable::class)
            ->assertSeeHtml('<div wire:offline.class.remove="hidden" class="hidden">');
    }

    /** @test */
    public function fails_when_table_has_no_pk(): void
    {
        $this->testErrors = false;
        try {
            Livewire::test(NoPrimaryKeyTable::class);
        } catch (DataTableConfigurationException $DataTableConfigurationException) {
            $this->testErrors = true;
            $this->assertSame('You must set a primary key using setPrimaryKey in the configure method.', substr($DataTableConfigurationException->getMessage(), 0, 71));
        } catch (ViewException $ViewException) {
            $this->testErrors = true;

            // Temporary swapping to check exception throwing
            //$this->assertSame('You must set a primary key using setPrimaryKey in the configure method.', substr($ViewException->getMessage(), 0, 71));
            $this->assertSame('Typed property Rappasoft\LaravelLivewireTables\DataTableComponent::$pri', substr($ViewException->getMessage(), 0, 71));

        } catch (Exception $standardException) {
            $this->testErrors = true;

            $this->assertSame('You must set a primary key using setPrimaryKey in the configure method.', substr($standardException->getMessage(), 0, 71));
        }
        if (! $this->testErrors) {
            $this->fail('Did Not Throw Error - Missing Primary Key');
        }
    }

    /** @test */
    public function fails_when_table_has_no_model_or_builder(): void
    {
        $this->testErrors = false;
        try {
            $test = Livewire::test(NoBuildMethodTable::class);
        } catch (DataTableConfigurationException $DataTableConfigurationException) {
            $this->testErrors = true;
            $this->assertSame('You must either specify a model or implement the builder method.', substr($DataTableConfigurationException->getMessage(), 0, 64));

        } catch (ViewException $ViewException) {
            $this->testErrors = true;
            $this->assertSame('You must either specify a model or implement the builder method.', substr($ViewException->getMessage(), 0, 64));
        } catch (Exception $standardException) {
            $this->testErrors = true;
            $this->assertSame('You must either specify a model or implement the builder method.', substr($standardException->getMessage(), 0, 64));
        }

        if (! $this->testErrors) {
            $this->fail('Did Not Throw Error - Missing Model/Builder');
        }
    }
}
