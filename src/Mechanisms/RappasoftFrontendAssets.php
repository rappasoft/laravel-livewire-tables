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
            $scriptPath = rtrim(config('livewire-tables.script_base_path', '/rappasoft/laravel-livewire-tables'), '/').'/core.min.js';

            return Route::get($scriptPath, $handle);
        });

        // Set the CSS route for the core tables CSS
        app($this::class)->setRappasoftTableStylesRoute(function ($handle) {
            $stylesPath = rtrim(config('livewire-tables.script_base_path', '/rappasoft/laravel-livewire-tables'), '/').'/core.min.css';

            return Route::get($stylesPath, $handle);
        });

        // Set the JS route for the third party JS
        app($this::class)->setRappasoftTableThirdPartyScriptRoute(function ($handle) {
            $scriptPath = rtrim(config('livewire-tables.script_base_path', '/rappasoft/laravel-livewire-tables'), '/').'/thirdparty.min.js';

            return Route::get($scriptPath, $handle);
        });

        // Set the CSS route for the third party CSS
        app($this::class)->setRappasoftTableThirdPartyStylesRoute(function ($handle) {
            $stylesPath = rtrim(config('livewire-tables.script_base_path', '/rappasoft/laravel-livewire-tables'), '/').'/thirdparty.css';

            return Route::get($stylesPath, $handle);
        });

        static::registerBladeDirectives();

    }

    protected function registerBladeDirectives()
    {
        Blade::directive('rappasoftTableScripts', [static::class, 'rappasoftTableScripts']);
        Blade::directive('rappasoftTableStyles', [static::class, 'rappasoftTableStyles']);
        Blade::directive('rappasoftTableThirdPartyScripts', [static::class, 'rappasoftTableThirdPartyScripts']);
        Blade::directive('rappasoftTableThirdPartyStyles', [static::class, 'rappasoftTableThirdPartyStyles']);
    }

    protected function pretendResponseIsJs(string $file): \Symfony\Component\HttpFoundation\Response
    {

        if (config('livewire-tables.cache_assets', false) === true) {
            $expires = strtotime('+1 day');
            $lastModified = filemtime($file);
            $cacheControl = 'public, max-age=86400';
        } else {
            $expires = strtotime('+1 second');
            $lastModified = \Carbon\Carbon::now()->timestamp;
            $cacheControl = 'public, max-age=1';
        }

        $headers = [
            'Content-Type' => 'application/javascript; charset=utf-8',
            'Expires' => Utils::httpDate($expires),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => Utils::httpDate($lastModified),
        ];

        return response()->file($file, $headers);
    }

    protected function pretendResponseIsCSS(string $file): \Symfony\Component\HttpFoundation\Response
    {
        if (config('livewire-tables.cache_assets', false) === true) {
            $expires = strtotime('+1 day');
            $lastModified = filemtime($file);
            $cacheControl = 'public, max-age=86400';
        } else {
            $expires = strtotime('+1 second');
            $lastModified = \Carbon\Carbon::now()->timestamp;
            $cacheControl = 'public, max-age=1';
        }

        $headers = [
            'Content-Type' => 'text/css; charset=utf-8',
            'Expires' => Utils::httpDate($expires),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => Utils::httpDate($lastModified),
        ];

        return response()->file($file, $headers);
    }

    /*
    public function maps(): \Symfony\Component\HttpFoundation\Response
    {
        return Utils::pretendResponseIsFile(__DIR__.'/../../../resources/js/laravel-livewire-tables.min.js.map');
    }

    protected static function minify(string $subject): array|string|null
    {
        return preg_replace('~(\v|\t|\s{2,})~m', '', $subject);
    }*/
}
