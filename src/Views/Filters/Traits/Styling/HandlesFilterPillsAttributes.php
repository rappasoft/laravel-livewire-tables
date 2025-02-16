<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Styling;

use Illuminate\View\ComponentAttributeBag;

trait HandlesFilterPillsAttributes
{
    /**
     * [Description for $pillAttributes]
     *
     * @var array<mixed>
     */
    protected array $pillAttributes = [];

    /**
     * [Description for $pillResetButtonAttributes]
     *
     * @var array<mixed>
     */
    protected array $pillResetButtonAttributes = [];

    protected bool $pillTitleAsHtml = false;

    public function getPillAttributesBag(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getPillAttributes());
    }

    public function hasPillAttributes(): bool
    {
        return ! empty($this->pillAttributes);
    }

    /**
     * [Description for getPillAttributes]
     *
     * @return array<mixed>
     */
    public function getPillAttributes(): array
    {
        $attributes = array_merge(['default-colors' => true, 'default-styling' => true], $this->pillAttributes);
        ksort($attributes);

        return $attributes;
    }

    public function setPillAttributes(array $pillAttributes): self
    {
        $this->pillAttributes = array_merge([
            'default-colors' => true,
            'default-styling' => true,
        ], $pillAttributes);

        return $this;
    }

    public function setPillResetButtonAttributes(array $attributes = []): self
    {
        $this->pillResetButtonAttributes = [...$this->getPillResetButtonAttributes(), ...$attributes];

        return $this;
    }

    public function getPillResetButtonAttributes(): array
    {
        return $this->pillResetButtonAttributes ?? [];
    }

    /**
     * [Description for getFilterPillResetButtonAttributesMerged]
     *
     * @param  array<mixed>  $resetFilterButtonAttributes
     * @return array<mixed>
     */
    public function getFilterPillResetButtonAttributesMerged(array $resetFilterButtonAttributes): array
    {
        return array_merge(
            [
                'x-on:click.prevent' => "resetSpecificFilter('".$this->getKey()."')",
                'type' => 'button',
            ],
            $resetFilterButtonAttributes,
            $this->getPillResetButtonAttributes()
        );
    }

    public function setFilterPillTitleAsHtml(bool $pillTitleAsHtml): self
    {
        $this->pillTitleAsHtml = $pillTitleAsHtml;

        return $this;
    }

    public function getFilterPillTitleAsHtml(): bool
    {
        return $this->pillTitleAsHtml;
    }
}
