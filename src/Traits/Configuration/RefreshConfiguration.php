<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait RefreshConfiguration
{
    /**
     * Set refresh time in milliseconds
     */
    public function setRefreshTime(int $time): self
    {
        $this->refresh = (string) $time;

        return $this;
    }

    /**
     * Set refresh interval using a time string (e.g., '10s', '30s', '1m', '5m')
     * Supports: s (seconds), m (minutes), h (hours)
     */
    public function poll(string $interval): self
    {
        $this->refresh = $this->parsePollInterval($interval);

        return $this;
    }

    /**
     * Parse poll interval string to milliseconds
     * Examples: '10s' => 10000, '30s' => 30000, '1m' => 60000
     */
    protected function parsePollInterval(string $interval): string
    {
        if (preg_match('/^(\d+)(s|m|h)$/i', $interval, $matches)) {
            $value = (int) $matches[1];
            $unit = strtolower($matches[2]);

            return match ($unit) {
                's' => (string) ($value * 1000),
                'm' => (string) ($value * 60 * 1000),
                'h' => (string) ($value * 60 * 60 * 1000),
                default => (string) ($value * 1000),
            };
        }

        // If it doesn't match the pattern, treat as milliseconds
        return is_numeric($interval) ? $interval : (string) ((int) $interval * 1000);
    }

    public function setRefreshKeepAlive(): self
    {
        $this->refresh = 'keep-alive';

        return $this;
    }

    public function setRefreshVisible(): self
    {
        $this->refresh = 'visible';

        return $this;
    }

    public function setRefreshMethod(string $method): self
    {
        $this->refresh = $method;

        return $this;
    }
}
