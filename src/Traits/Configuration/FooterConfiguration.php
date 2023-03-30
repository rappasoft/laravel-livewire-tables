<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait FooterConfiguration
{
    /**
     * @param bool $status
     *
     * @return self
     */
    public function setFooterStatus(bool $status): self
    {
        $this->footerStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setFooterEnabled(): self
    {
        $this->setFooterStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setFooterDisabled(): self
    {
        $this->setFooterStatus(false);

        return $this;
    }

    /**
     * @param bool $status
     *
     * @return self
     */
    public function setUseHeaderAsFooterStatus(bool $status): self
    {
        $this->useHeaderAsFooterStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setUseHeaderAsFooterEnabled(): self
    {
        $this->setUseHeaderAsFooterStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setUseHeaderAsFooterDisabled(): self
    {
        $this->setUseHeaderAsFooterStatus(false);

        return $this;
    }

    /**
     * @param callable $callback
     *
     * @return self
     */
    public function setFooterTrAttributes(callable $callback): self
    {
        $this->footerTrAttributesCallback = $callback;

        return $this;
    }

    /**
     * @param callable $callback
     *
     * @return self
     */
    public function setFooterTdAttributes(callable $callback): self
    {
        $this->footerTdAttributesCallback = $callback;

        return $this;
    }
}
