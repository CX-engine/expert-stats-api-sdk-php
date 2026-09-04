<?php

namespace CXEngine\ExpertStats\Requests\Stats;

class ResourceGroupsRequest extends HostScopedStatsRequest
{
    protected function path(): string
    {
        return 'resource-groups';
    }
}
