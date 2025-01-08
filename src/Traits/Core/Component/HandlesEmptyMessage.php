<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Component;

trait HandlesEmptyMessage
{
    protected string $emptyMessage = 'No items found, try to broaden your search';

    /**
     * Get the translated empty message of the table
     */
    public function getEmptyMessage(): string
    {
        if ($this->emptyMessage == 'No items found, try to broaden your search') {
            return __($this->getLocalisationPath().'No items found, try to broaden your search');
        }

        return $this->emptyMessage;
    }

    /**
     * Set the empty message
     */
    public function setEmptyMessage(string $message): self
    {
        $this->emptyMessage = $message;

        return $this;
    }
}
