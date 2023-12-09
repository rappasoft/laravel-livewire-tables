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
    public function setCustomEmptyViewClasses(string $customEmptyViewClasses): self
    {
        $this->customEmptyClasses['view'] = $customEmptyViewClasses;

        return $this;
    }

    /**
     * Used to set classes for the Empty Row
     */
    public function setCustomEmptyRowClasses(string $customEmptyRowClasses): self
    {
        $this->customEmptyClasses['row'] = $customEmptyRowClasses;

        return $this;
    }

    /**
     * Used to set classes for the Empty Column
     */
    public function setCustomEmptyColClasses(string $customEmptyColClasses): self
    {
        $this->customEmptyClasses['col'] = $customEmptyColClasses;

        return $this;
    }

    /**
     * Used to set classes for the Empty Div
     */
    public function setCustomEmptyDivClasses(string $customEmptyDivClasses): self
    {
        $this->customEmptyClasses['div'] = $customEmptyDivClasses;

        return $this;
    }

    /**
     * Used to set classes for the Empty Span
     */
    public function setCustomEmptySpanClasses(string $customEmptySpanClasses): self
    {
        $this->customEmptyClasses['span'] = $customEmptySpanClasses;

        return $this;
    }
}
