<?php

namespace CXEngine\ExpertStats\Requests\Stats;

class MapRequest extends HostScopedStatsRequest
{
    protected function path(): string
    {
        return 'map';
    }
}
