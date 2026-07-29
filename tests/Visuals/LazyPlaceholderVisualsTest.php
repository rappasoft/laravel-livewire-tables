<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Visuals')]
final class LazyPlaceholderVisualsTest extends TestCase
{
    // Declared by whichever element carries them, not by laravellivewiretable()
    private const NOT_TABLE_SCOPE = ['childElementOpen', 'tableName'];

    public function test_placeholder_is_a_single_root_with_the_fallback_scope(): void
    {
        $table = Livewire::test(PetsTable::class)->instance();

        $this->assertSame(
            '<div x-data="'.$table->getAlpineFallbackScope().'"></div>',
            $table->placeholder()
        );
    }

    public function test_fallback_scope_declares_every_table_variable_the_views_reference(): void
    {
        $js = file_get_contents(__DIR__.'/../../resources/js/laravel-livewire-tables.js');
        $scope = substr($js, $start = strpos($js, "Alpine.data('laravellivewiretable'"), strpos($js, 'Alpine.data(', $start + 1) - $start);
        preg_match_all('/^ {8}([a-zA-Z]+):/m', $scope, $matches);

        $fallback = Livewire::test(PetsTable::class)->instance()->getAlpineFallbackScope();
        $views = implode('', array_map('file_get_contents', $this->bladeFiles()));

        $missing = [];

        foreach (array_diff($matches[1], self::NOT_TABLE_SCOPE) as $variable) {
            if (preg_match('/(x-|@|:)[a-z:.-]*="[^"]*\b'.$variable.'\b/', $views) && ! str_contains($fallback, $variable.':')) {
                $missing[] = $variable;
            }
        }

        $this->assertSame([], $missing, 'getAlpineFallbackScope() is missing variables the views reference, so lazy-loaded tables will throw Alpine ReferenceErrors.');
    }

    /**
     * @return list<string>
     */
    private function bladeFiles(): array
    {
        $files = [];

        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(__DIR__.'/../../resources/views')) as $file) {
            if ($file->getExtension() === 'php') {
                $files[] = $file->getPathname();
            }
        }

        return $files;
    }
}
