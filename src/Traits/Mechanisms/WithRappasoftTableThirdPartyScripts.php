<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Mechanisms;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Livewire\Drawer\Utils;

trait WithRappasoftTableThirdPartyScripts
{
    /** Rappasoft Third Party Scripts */
    public bool $hasRenderedRappsoftTableThirdPartyScripts = false;

    public mixed $rappasoftTableScriptThirdPartyRoute;

    public array $rappasoftTableScriptThirdPartyTagAttributes = [];

    public function bootWithRappasoftTableThirdPartyScripts()
    {
        // Set the JS route for the third party JS
        app($this::class)->setRappasoftTableThirdPartyScriptRoute(function ($handle) {
            $scriptPath = '/livewire/rappasoft-laravel-livewire-tables-thirdparty.js';

            return Route::get($scriptPath, $handle);
        });

        Blade::directive('rappasoftTableThirdPartyScripts', [static::class, 'rappasoftTableThirdPartyScripts']);

    }

    
    /** 
     * 
     * Rappasoft Third Party Scripts 
     * 
     */
    /** 
     * Used if Injection Is Used 
     */
    public function setRappasoftTableThirdPartyScriptRoute(callable $callback): void
    {
        $route = $callback([self::class, 'returnRappasoftTableThirdPartyJavaScriptAsFile']);

        $this->rappasoftTableScriptThirdPartyRoute = $route;
    }

    public function returnRappasoftTableThirdPartyJavaScriptAsFile(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->pretendResponseIsJs(__DIR__.'/../..//../resources/js/laravel-livewire-tables-thirdparty.js');
    }

    /** 
     *  Used If Injection is Disabled
     */
    public static function rappasoftTableThirdPartyScripts(mixed $expression): string
    {
        return '{!! \Rappasoft\LaravelLivewireTables\Mechanisms\RappasoftFrontendAssets::tableThirdPartyScripts('.$expression.') !!}';
    }

    public static function tableThirdPartyScripts(array $options = []): ?string
    {
        app(static::class)->hasRenderedRappsoftTableThirdPartyScripts = true;

        $debug = config('app.debug');

        $scripts = static::tableThirdpartyJs($options);

        // HTML Label.
        $html = $debug ? ['<!-- Rappasoft Third Party Scripts -->'] : [];

        $html[] = $scripts;

        return implode("\n", $html);
    }

    public static function tableThirdpartyJs(array $options = []): string
    {
        // Use the default endpoint...
        $url = app(static::class)->rappasoftTableScriptThirdPartyRoute->uri;

        $url = rtrim($url, '/');

        $url = (string) str($url)->start('/');

        // Add the build manifest hash to it...

        $nonce = isset($options['nonce']) ? "nonce=\"{$options['nonce']}\"" : '';

        $extraAttributes = Utils::stringifyHtmlAttributes(
            app(static::class)->rappasoftTableScriptTagAttributes,
        );

        return <<<HTML
        <script  src="{$url}"  {$nonce} {$extraAttributes}></script>
        HTML;
    }
}
