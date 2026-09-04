<?php

namespace CXEngine\ExpertStats\Requests\Stats;

class OriginRequest extends HostScopedStatsRequest
{
    /**
     * @param  array<string, mixed>  $query
     */
    public function __construct(
        string $hostName,
        protected readonly string $type,
        array $query = [],
        protected readonly bool $top = false,
    ) {
        parent::__construct($hostName, $query);
    }

    protected function path(): string
    {
        $segment = $this->top ? 'origin-top' : 'origin';

        return "{$segment}/{$this->type}";
    }
}
