<?php

namespace CXEngine\ExpertStats\Requests\Stats;

class CallerNumbersSearchRequest extends HostScopedStatsRequest
{
    protected function path(): string
    {
        return 'caller-numbers';
    }
}
