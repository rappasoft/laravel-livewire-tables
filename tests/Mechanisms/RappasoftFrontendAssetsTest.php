<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Mechanisms;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Mechanisms\RappasoftFrontendAssets;
use function Livewire\trigger;

class RappasoftFrontendAssetsTest extends TestCase
{

        /** @test */
        public function styles()
        {
            $assets = app(RappasoftFrontendAssets::class);
    
            $this->assertFalse($assets->hasRenderedRappsoftTableStyles);
    
            $this->assertStringStartsWith('<link href="/rappasoft/laravel-livewire-tables/core.min.css" rel="stylesheet" />', ltrim($assets->tableStyles()));
    
            $this->assertTrue($assets->hasRenderedRappsoftTableStyles);
        }
    
        /** @test */
        public function scripts()
        {
            $assets = app(RappasoftFrontendAssets::class);
    
            $this->assertFalse($assets->hasRenderedRappsoftTableScripts);
    
            $this->assertStringStartsWith('<script src="', $assets->tableScripts());
    
            $this->assertTrue($assets->hasRenderedRappsoftTableScripts);
        }

}
