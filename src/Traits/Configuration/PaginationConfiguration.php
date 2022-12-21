<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait PaginationConfiguration
{
    /**
    * @param  string  $name
    *
    * @return string
    */
    public function setPageName(string $name): self
    {
        $this->pageName = $name;

        return $this;
    }

    /**
     * @param  string  $theme
     *
     * @return $this
     */
    public function setPaginationTheme(string $theme): self
    {
        $this->paginationTheme = $theme;

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return $this
     */
    public function setPaginationStatus(bool $status): self
    {
        $this->paginationStatus = $status;

        return $this;
    }

    /**
     * @return $this
     */
    public function setPaginationEnabled(): self
    {
        $this->setPaginationStatus(true);

        return $this;
    }

    /**
     * @return $this
     */
    public function setPaginationDisabled(): self
    {
        $this->setPaginationStatus(false);

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return $this
     */
    public function setPaginationVisibilityStatus(bool $status): self
    {
        $this->paginationVisibilityStatus = $status;

        return $this;
    }

    /**
     * @return $this
     */
    public function setPaginationVisibilityEnabled(): self
    {
        $this->setPaginationVisibilityStatus(true);

        return $this;
    }

    /**
     * @return $this
     */
    public function setPaginationVisibilityDisabled(): self
    {
        $this->setPaginationVisibilityStatus(false);

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return $this
     */
    public function setPerPageVisibilityStatus(bool $status): self
    {
        $this->perPageVisibilityStatus = $status;

        return $this;
    }

    /**
     * @return $this
     */
    public function setPerPageVisibilityEnabled(): self
    {
        $this->setPerPageVisibilityStatus(true);

        return $this;
    }

    /**
     * @return $this
     */
    public function setPerPageVisibilityDisabled(): self
    {
        $this->setPerPageVisibilityStatus(false);

        return $this;
    }

    /**
     * @param  array  $accepted
     *
     * @return $this
     */
    public function setPerPageAccepted(array $accepted): self
    {
        $this->perPageAccepted = $accepted;

        return $this;
    }

    /**
     * @param  int  $perPage
     *
     * @return $this
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
     * @return $this
     */
    public function setPaginationMethod(string $paginationMethod): self
    {
        $this->paginationMethod = $paginationMethod;

        return $this;
    }
}
