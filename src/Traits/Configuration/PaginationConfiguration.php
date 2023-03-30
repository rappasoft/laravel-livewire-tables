<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait PaginationConfiguration
{
    /**
     * @param string $name
     *
     * @return self
     */
    public function setPageName(string $name): self
    {
        $this->pageName = $name;

        return $this;
    }

    /**
     * @param string $theme
     *
     * @return self
     */
    public function setPaginationTheme(string $theme): self
    {
        $this->paginationTheme = $theme;

        return $this;
    }

    /**
     * @param bool $status
     *
     * @return self
     */
    public function setPaginationStatus(bool $status): self
    {
        $this->paginationStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setPaginationEnabled(): self
    {
        $this->setPaginationStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setPaginationDisabled(): self
    {
        $this->setPaginationStatus(false);

        return $this;
    }

    /**
     * @param bool $status
     *
     * @return self
     */
    public function setPaginationVisibilityStatus(bool $status): self
    {
        $this->paginationVisibilityStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setPaginationVisibilityEnabled(): self
    {
        $this->setPaginationVisibilityStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setPaginationVisibilityDisabled(): self
    {
        $this->setPaginationVisibilityStatus(false);

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setPerPageVisibilityStatus(bool $status): self
    {
        $this->perPageVisibilityStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setPerPageVisibilityEnabled(): self
    {
        $this->setPerPageVisibilityStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setPerPageVisibilityDisabled(): self
    {
        $this->setPerPageVisibilityStatus(false);

        return $this;
    }

    /**
     * @param  array<mixed>  $accepted
     *
     * @return self
     */
    public function setPerPageAccepted(array $accepted): self
    {
        $this->perPageAccepted = $accepted;

        return $this;
    }

    /**
     * @param  int  $perPage
     *
     * @return self
     * @throws DataTableConfigurationException
     */
    public function setPerPage(int $perPage): self
    {
        if (! in_array($perPage, $this->getPerPageAccepted(), true)) {
            throw new DataTableConfigurationException('You can only set per page values that are in your accepted values list.');
        }

        $this->perPage = $perPage;

        return $this;
    }

    /**
     * @param  string  $paginationMethod
     *
     * @return self
     */
    public function setPaginationMethod(string $paginationMethod): self
    {
        $this->paginationMethod = $paginationMethod;

        return $this;
    }
}
