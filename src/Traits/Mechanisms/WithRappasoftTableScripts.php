<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Mechanisms;

use Livewire\Drawer\Utils;

trait WithRappasoftTableScripts
{
    /** Rappasoft Scripts */
    public bool $hasRenderedRappsoftTableScripts = false;

    public mixed $rappasoftTableScriptRoute;

    public array $rappasoftTableScriptTagAttributes = [];

    public function useRappasoftTableScriptTagAttributes(array $attributes): void
    {
        $this->rappasoftTableScriptTagAttributes = [...$this->rappasoftTableScriptTagAttributes, ...$attributes];
    }

    /**
     *  Used If Injection is Enabled
     */
    public function setRappasoftTableScriptRoute(callable $callback): void
    {
        $route = $callback([self::class, 'returnRappasoftTableJavaScriptAsFile']);

        $this->rappasoftTableScriptRoute = $route;
    }

    public function returnRappasoftTableJavaScriptAsFile(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->pretendResponseIsJs(__DIR__.'/../../../resources/js/laravel-livewire-tables.min.js');
    }

    /**
     *  Used if Injection is disabled
     */
    public static function rappasoftTableScripts(mixed $expression): string
    {
        return '{!! \Rappasoft\LaravelLivewireTables\Mechanisms\RappasoftFrontendAssets::tableScripts('.$expression.') !!}';
    }

    public static function tableScripts(array $options = []): ?string
    {
        app(static::class)->hasRenderedRappsoftTableScripts = true;

        $debug = config('app.debug');

        $scripts = static::tableJs($options);

        // HTML Label.
        $html = $debug ? ['<!-- Rappasoft Core Table Scripts -->'] : [];

        $html[] = $scripts;

        return implode("\n", $html);
    }

    public static function tableJs(array $options = []): string
    {
        // Use the default endpoint...
        $url = app(static::class)->rappasoftTableScriptRoute->uri;

        $url = rtrim($url, '/');

        $url = (string) str($url)->start('/');

        // Add the build manifest hash to it...

        $nonce = isset($options['nonce']) ? "nonce=\"{$options['nonce']}\"" : '';

        $extraAttributes = Utils::stringifyHtmlAttributes(
            app(static::class)->rappasoftTableScriptTagAttributes,
        );

        return <<<HTML
        <script src="{$url}" {$nonce} {$extraAttributes}></script>
        HTML;
    }
}
