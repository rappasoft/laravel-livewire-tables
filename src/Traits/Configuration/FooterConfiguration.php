<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait FooterConfiguration
{
    public function setFooterStatus(bool $status): self
    {
        $this->footerStatus = $status;

        return $this;
    }

    public function setFooterEnabled(): self
    {
        $this->setFooterStatus(true);

        return $this;
    }

    public function setFooterDisabled(): self
    {
        $this->setFooterStatus(false);

        return $this;
    }

    public function setUseHeaderAsFooterStatus(bool $status): self
    {
        $this->useHeaderAsFooterStatus = $status;

        return $this;
    }

    public function setUseHeaderAsFooterEnabled(): self
    {
        $this->setUseHeaderAsFooterStatus(true);

        return $this;
    }

    public function setUseHeaderAsFooterDisabled(): self
    {
        $this->setUseHeaderAsFooterStatus(false);

        return $this;
    }

    public function setFooterTrAttributes(callable $callback): self
    {
        $this->footerTrAttributesCallback = $callback;

        return $this;
    }

    public function setFooterTdAttributes(callable $callback): self
    {
        $this->footerTdAttributesCallback = $callback;

        return $this;
    }
}
