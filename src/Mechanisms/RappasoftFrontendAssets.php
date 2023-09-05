<?php

namespace Rappasoft\LaravelLivewireTables\Mechanisms;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Livewire\Drawer\Utils;
use Rappasoft\LaravelLivewireTables\Traits\Mechanisms\WithRappasoftTableScripts;
use Rappasoft\LaravelLivewireTables\Traits\Mechanisms\WithRappasoftTableStyles;
use Rappasoft\LaravelLivewireTables\Traits\Mechanisms\WithRappasoftTableThirdPartyScripts;
use Rappasoft\LaravelLivewireTables\Traits\Mechanisms\WithRappasoftTableThirdPartyStyles;

class RappasoftFrontendAssets
{
    use WithRappasoftTableScripts;
    use WithRappasoftTableStyles;
    use WithRappasoftTableThirdPartyScripts;
    use WithRappasoftTableThirdPartyStyles;

    public function register(): void
    {
        app()->singleton($this::class);
    }

    public function boot(): void
    {
        // Set the JS route for the core tables JS
        app($this::class)->setRappasoftTableScriptRoute(function ($handle) {
            $scriptPath = '/rappasoft/laravel-livewire-tables/core.min.js';

            return Route::get($scriptPath, $handle);
        });

        Blade::directive('rappasoftTableScripts', [static::class, 'rappasoftTableScripts']);

        // Set the CSS route for the core tables CSS
        app($this::class)->setRappasoftTableStylesRoute(function ($handle) {
            $stylesPath = '/rappasoft/laravel-livewire-tables/core.min.css';

            return Route::get($stylesPath, $handle);
        });

        Blade::directive('rappasoftTableStyles', [static::class, 'rappasoftTableStyles']);

        // Set the JS route for the third party JS
        app($this::class)->setRappasoftTableThirdPartyScriptRoute(function ($handle) {
            $scriptPath = '/rappasoft/laravel-livewire-tables/thirdparty.min.js';

            return Route::get($scriptPath, $handle);
        });

        Blade::directive('rappasoftTableThirdPartyScripts', [static::class, 'rappasoftTableThirdPartyScripts']);

        // Set the CSS route for the third party CSS
        app($this::class)->setRappasoftTableThirdPartyStylesRoute(function ($handle) {
            $stylesPath = '/rappasoft/laravel-livewire-tables/thirdparty.css';

            return Route::get($stylesPath, $handle);
        });

        Blade::directive('rappasoftTableThirdPartyStyles', [static::class, 'rappasoftTableThirdPartyStyles']);

    }

    protected function setupJSHeaders(int|false|string $lastModified): array
    {
        return [
            'Content-Type' => 'application/javascript; charset=utf-8',
            'Expires' => Utils::httpDate(strtotime((config('livewire-tables.cache_assets', false) ? '+1 second' : '+1 hour'))),
            'Cache-Control' => (config('livewire-tables.cache_assets', false) ? 'public, max-age=1' : 'public, max-age=3600'),
            'Last-Modified' => Utils::httpDate((config('livewire-tables.cache_assets', false) ? strtotime(now()) : $lastModified)),
        ];
    }

    protected function pretendResponseIsJs(string $file): \Symfony\Component\HttpFoundation\Response
    {
        return response()->file($file, $this->setupJSHeaders(filemtime($file)));
    }

    protected function setupCSSHeaders(int|false|string $lastModified): array
    {
        return [
            'Content-Type' => 'text/css; charset=utf-8',
            'Expires' => Utils::httpDate(strtotime((config('livewire-tables.cache_assets', false) ? '+1 second' : '+1 hour'))),
            'Cache-Control' => (config('livewire-tables.cache_assets', false) ? 'public, max-age=1' : 'public, max-age=3600'),
            'Last-Modified' => Utils::httpDate((config('livewire-tables.cache_assets', false) ? strtotime(now()) : $lastModified)),
        ];
    }

    protected function pretendResponseIsCSS(string $file): \Symfony\Component\HttpFoundation\Response
    {

        return response()->file($file, $this->setupCSSHeaders(filemtime($file)));
    }

    public function maps(): \Symfony\Component\HttpFoundation\Response
    {
        return Utils::pretendResponseIsFile(__DIR__.'/../../../resources/js/laravel-livewire-tables.min.js.map');
    }

    protected static function minify(string $subject): array|string|null
    {
        return preg_replace('~(\v|\t|\s{2,})~m', '', $subject);
    }
}
