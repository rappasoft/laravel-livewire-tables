<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait EmptyMessageConfiguration
{
    /**
     * Used to set a Custom Empty View
     */
    public function setCustomEmptyView(string $customEmptyView): self
    {
        $this->customEmptyView = $customEmptyView;

        return $this;
    }

    
    /**
     * Used to set classes for the Custom Empty View Classes
     */
    public function setCustomEmptyClasses(array $customEmptyClasses): self
    {
        $this->customEmptyClasses = [$this->customEmptyClasses, ...$customEmptyClasses];

        return $this;
    }


    /**
     * Used to set classes for the Custom Empty View Classes
     */
    public function setCustomEmptyViewClasses(string $customEmptyClasses, bool $append = false): self
    {
        $this->customEmptyClasses['view'] = ($append) ? $this->customEmptyClasses['view'] . ' ' . $customEmptyClasses : $customEmptyClasses;

        return $this;
    }

    /**
     * Used to set classes for the Empty Row
     */
    public function setCustomEmptyRowClasses(string $customEmptyClasses, bool $append = false): self
    {
        $this->customEmptyClasses['row'] = ($append) ? $this->customEmptyClasses['row'] . ' ' . $customEmptyClasses : $customEmptyClasses;

        return $this;
    }

    /**
     * Used to set classes for the Empty Column
     */
    public function setCustomEmptyColClasses(string $customEmptyClasses, bool $append = false): self
    {
        $this->customEmptyClasses['col'] = ($append) ? $this->customEmptyClasses['col'] . ' ' . $customEmptyClasses : $customEmptyClasses;

        return $this;
    }

    /**
     * Used to set classes for the Empty Div
     */
    public function setCustomEmptyDivClasses(string $customEmptyClasses, bool $append = false): self
    {
        $this->customEmptyClasses['div'] = ($append) ? $this->customEmptyClasses['div'] . ' ' . $customEmptyClasses : $customEmptyClasses;

        return $this;
    }

    /**
     * Used to set classes for the Empty Span
     */
    public function setCustomEmptySpanClasses(string $customEmptyClasses, bool $append = false): self
    {
        $this->customEmptyClasses['span'] = ($append) ? $this->customEmptyClasses['span'] . ' ' . $customEmptyClasses : $customEmptyClasses;

        return $this;
    }
}
