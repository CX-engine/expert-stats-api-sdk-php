<?php

namespace CXEngine\ExpertStats\Requests\Stats;

class KpiRequest extends HostScopedStatsRequest
{
    /**
     * @param  array<string, mixed>  $query
     */
    public function __construct(
        string $hostName,
        protected readonly string $type,
        protected readonly string $granularity,
        array $query = [],
    ) {
        parent::__construct($hostName, $query);
    }

    protected function path(): string
    {
        return "kpi/{$this->type}/{$this->granularity}";
    }
}
