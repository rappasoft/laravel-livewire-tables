<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait FooterConfiguration
{
    /**
     * @var bool
     */
    public function setFooterStatus(bool $status): self
    {
        $this->footerStatus = $status;

        return $this;
    }

    /**
     * @var bool
     */
    public function setFooterEnabled(): self
    {
        $this->setFooterStatus(true);

        return $this;
    }

    /**
     * @var bool
     */
    public function setFooterDisabled(): self
    {
        $this->setFooterStatus(false);

        return $this;
    }

    /**
     * @var bool
     */
    public function setUseHeaderAsFooterStatus(bool $status): self
    {
        $this->useHeaderAsFooterStatus = $status;

        return $this;
    }

    /**
     * @var bool
     */
    public function setUseHeaderAsFooterEnabled(): self
    {
        $this->setUseHeaderAsFooterStatus(true);

        return $this;
    }

    /**
     * @var bool
     */
    public function setUseHeaderAsFooterDisabled(): self
    {
        $this->setUseHeaderAsFooterStatus(false);

        return $this;
    }

    /**
     * @var bool
     */
    public function setFooterTrAttributes(callable $callback): self
    {
        $this->footerTrAttributesCallback = $callback;

        return $this;
    }

    /**
     * @var bool
     */
    public function setFooterTdAttributes(callable $callback): self
    {
        $this->footerTdAttributesCallback = $callback;

        return $this;
    }
}
