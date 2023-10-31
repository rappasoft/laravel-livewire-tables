<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Mechanisms;

trait WithRappasoftTableStyles
{
    /** Rappasoft Styles */
    public bool $hasRenderedRappsoftTableStyles = false;

    public mixed $rappasoftTableStylesRoute;

    public array $rappasoftTableStyleTagAttributes = [];

    /**
     *  Used If Injection is Enabled
     */
    public function setRappasoftTableStylesRoute(callable $callback): void
    {
        $route = $callback([self::class, 'returnRappasoftTableStylesAsFile']);

        $this->rappasoftTableStylesRoute = $route;
    }

    public function returnRappasoftTableStylesAsFile(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->pretendResponseIsCSS(__DIR__.'/../../../resources/css/laravel-livewire-tables.min.css');
    }

    /**
     *  Used If Injection is Disabled
     */
    public static function rappasoftTableStyles(mixed $expression): string
    {
        return '{!! \Rappasoft\LaravelLivewireTables\Mechanisms\RappasoftFrontendAssets::tableStyles('.$expression.') !!}';
    }

    public static function tableStyles(array $options = []): array|string|null
    {
        app(static::class)->hasRenderedRappsoftTableStyles = true;

        $debug = config('app.debug');

        $styles = static::tableCss($options);

        // HTML Label.
        $html = $debug ? ['<!-- Rappasoft Core Table Styles -->'] : [];

        $html[] = $styles;

        return implode("\n", $html);

    }

    public static function tableCss(array $options = []): ?string
    {
        $styleUrl = app(static::class)->rappasoftTableStylesRoute->uri;
        $styleUrl = rtrim($styleUrl, '/');

        $styleUrl = (string) str($styleUrl)->start('/');

        return <<<HTML
            <link href="{$styleUrl}" rel="stylesheet" />
        HTML;
    }
}
