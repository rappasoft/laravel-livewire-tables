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
        // Set the CSS route for the core tables CSS
        app($this::class)->setRappasoftTableStylesRoute(function ($handle) {
            $stylesPath = '/livewire/rappasoft-laravel-livewire-tables.css';

            return Route::get($stylesPath, $handle);
        });

        Blade::directive('rappasoftTableStyles', [static::class, 'rappasoftTableStyles']);

        // Set the JS route for the core tables JS
        app($this::class)->setRappasoftTableScriptRoute(function ($handle) {
            $scriptPath = '/livewire/rappasoft-laravel-livewire-tables.js';

            return Route::get($scriptPath, $handle);
        });

        Blade::directive('rappasoftTableScripts', [static::class, 'rappasoftTableScripts']);

    }

    protected function pretendResponseIsJs(string $file): \Symfony\Component\HttpFoundation\Response
    {
        $expires = strtotime('+1 minute');
        $lastModified = filemtime($file);
        $cacheControl = 'public, max-age=30';

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
        $expires = strtotime('+1 minute');
        $lastModified = filemtime($file);
        $cacheControl = 'public, max-age=60';

        $headers = [
            'Content-Type' => 'text/css; charset=utf-8',
            'Expires' => Utils::httpDate($expires),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => Utils::httpDate($lastModified),
        ];

        return response()->file($file, $headers);
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
