<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Mechanisms;

use Livewire\Drawer\Utils;

trait WithRappasoftTableThirdPartyScripts
{
    /** Rappasoft Third Party Scripts */
    public bool $hasRenderedRappsoftTableThirdPartyScripts = false;

    public mixed $rappasoftTableScriptThirdPartyRoute;

    public array $rappasoftTableScriptThirdPartyTagAttributes = [];

    /**
     * Rappasoft Third Party Scripts
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
        return $this->pretendResponseIsJs(__DIR__.'/../../../resources/js/laravel-livewire-tables-thirdparty.min.js');
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

        // HTML Label.
        $html = config('app.debug') ? ['<!-- Rappasoft Third Party Scripts -->'] : [];

        $html[] = static::tableThirdpartyJs($options);

        return implode("\n", $html);
    }

    public static function tableThirdpartyJs(array $options = []): string
    {
        // Use the default endpoint...
        $url = rtrim(app(static::class)->rappasoftTableScriptThirdPartyRoute->uri, '/');

        $url = (string) str($url)->start('/');

        // Add the build manifest hash to it...

        $nonce = isset($options['nonce']) ? " nonce=\"{$options['nonce']}\" " : '';

        $extraAttributes = Utils::stringifyHtmlAttributes(
            app(static::class)->rappasoftTableScriptTagAttributes,
        );

        return <<<HTML
        <script src="{$url}" type="module"{$nonce}{$extraAttributes}></script>
        HTML;
    }
}
