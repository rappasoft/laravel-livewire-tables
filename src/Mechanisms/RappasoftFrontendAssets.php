<?php

namespace Rappasoft\LaravelLivewireTables\Mechanisms;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Livewire\Drawer\Utils;

class RappasoftFrontendAssets
{
    public $hasRenderedRappsoftScripts = false;

    public $hasRenderedRappsoftStyles = false;

    public $rappasoftScriptRoute;

    public $rappasoftStylesRoute;

    public $rappasoftScriptTagAttributes = [];

    public function register()
    {
        app()->singleton($this::class);
    }

    public function boot()
    {
        app($this::class)->setRappaScriptRoute(function ($handle) {
            return Route::get('/livewire/rappa.js', $handle);
        });

        Blade::directive('rappasoftScripts', [static::class, 'rappasoftScripts']);
        Blade::directive('rappasoftStyles', [static::class, 'rappasoftStyles']);
    }

    public function useRappasoftScriptTagAttributes($attributes)
    {
        $this->rappasoftScriptTagAttributes = array_merge($this->rappasoftScriptTagAttributes, $attributes);
    }

    public function setRappaScriptRoute($callback)
    {
        $route = $callback([self::class, 'returnJavaScriptAsFile']);

        $this->rappasoftScriptRoute = $route;
    }

    public function setStylesRoute($callback)
    {
        $route = $callback([self::class, 'returnStylesAsFile']);

        $this->rappasoftStylesRoute = $route;
    }

    public static function rappasoftScripts($expression)
    {
        return '{!! \Rappasoft\LaravelLivewireTables\Mechanisms\FrontendAssets::scripts('.$expression.') !!}';
    }

    public static function rappasoftStyles($expression)
    {
        return '{!! \Rappasoft\LaravelLivewireTables\Mechanisms\FrontendAssets::styles('.$expression.') !!}';
    }

    public function returnJavaScriptAsFile()
    {
        return Utils::pretendResponseIsFile(__DIR__.'/../../resources/js/test.js');
    }

    public function returnStylesAsFile()
    {
        return Utils::pretendResponseIsFile(__DIR__.'/../../resources/css/test.css');
    }

    public function maps()
    {
        return Utils::pretendResponseIsFile(__DIR__.'/../../../resources/js/test.js.map');
    }

    public static function styles($options = [])
    {
        app(static::class)->hasRenderedRappsoftStyles = true;

        $nonce = isset($options['nonce']) ? "nonce=\"{$options['nonce']}\"" : '';

        $html = <<<HTML
        <!-- Rappasoft Styles -->
        <style {$nonce}>
            body { background-color: #000 !important; }
        </style>
        HTML;

        return static::minify($html);
    }

    public static function scripts($options = [])
    {
        app(static::class)->hasRenderedRappsoftScripts = true;

        $debug = config('app.debug');

        $scripts = static::js($options);

        // HTML Label.
        $html = $debug ? ['<!-- Rappasoft Scripts -->'] : [];

        $html[] = $scripts;

        return implode("\n", $html);
    }

    public static function js($options)
    {
        // Use the default endpoint...
        $url = app(static::class)->rappasoftScriptRoute->uri;

        $url = rtrim($url, '/');

        $url = (string) str($url)->start('/');

        // Add the build manifest hash to it...

        $token = app()->has('session.store') ? csrf_token() : '';

        $nonce = isset($options['nonce']) ? "nonce=\"{$options['nonce']}\"" : '';

        $progressBar = config('livewire.navigate.show_progress_bar', true) ? '' : 'data-no-progress-bar';

        $updateUri = app('livewire')->getUpdateUri();

        $extraAttributes = Utils::stringifyHtmlAttributes(
            app(static::class)->rappasoftScriptTagAttributes,
        );

        return <<<HTML
        <script src="{$url}" {$nonce} {$progressBar} data-csrf="{$token}" data-uri="{$updateUri}" {$extraAttributes}></script>
        HTML;
    }

    protected static function minify($subject)
    {
        return preg_replace('~(\v|\t|\s{2,})~m', '', $subject);
    }
}
