<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Mechanisms;

trait WithRappasoftTableThirdPartyStyles
{
    /** Rappasoft Third Party Styles */
    public bool $hasRenderedRappsoftTableThirdPartyStyles = false;

    public mixed $rappasoftTableThirdPartyStyleRoute;

    public array $rappasoftTableThirdPartyStyleTagAttributes = [];

    /**
     *  Used If Injection is Enabled
     */
    public function setRappasoftTableThirdPartyStylesRoute(callable $callback): void
    {
        $route = $callback([self::class, 'returnRappasoftTableThirdPartyStylesAsFile']);

        $this->rappasoftTableThirdPartyStyleRoute = $route;
    }

    public function returnRappasoftTableThirdPartyStylesAsFile(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->pretendResponseIsCSS(__DIR__.'/../../../resources/css/laravel-livewire-tables-thirdparty.css');
    }

    /**
     *  Used If Injection is Disabled
     */
    public static function rappasoftTableThirdPartyStyles(mixed $expression): string
    {
        return '{!! \Rappasoft\LaravelLivewireTables\Mechanisms\RappasoftFrontendAssets::tableThirdPartyStyles('.$expression.') !!}';
    }

    public static function tableThirdPartyStyles(array $options = []): array|string|null
    {
        app(static::class)->hasRenderedRappsoftTableThirdPartyStyles = true;

        // HTML Label.
        $html = config('app.debug')? ['<!-- Rappasoft Table Third Party Styles -->'] : [];

        $html[] = static::tableThirdPartyCss($options);

        return implode("\n", $html);

    }

    public static function tableThirdPartyCss(array $options = []): ?string
    {
        $styleUrl = rtrim(app(static::class)->rappasoftTableThirdPartyStyleRoute->uri, '/');

        $styleUrl = (string) str($styleUrl)->start('/');

        return <<<HTML
            <link href="{$styleUrl}" rel="stylesheet" />
        HTML;
    }
}
