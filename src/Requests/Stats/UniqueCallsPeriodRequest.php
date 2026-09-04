<?php

namespace CXEngine\ExpertStats\Requests\Stats;

class UniqueCallsPeriodRequest extends HostScopedStatsRequest
{
    protected function path(): string
    {
        return 'unique-calls-period';
    }
}
