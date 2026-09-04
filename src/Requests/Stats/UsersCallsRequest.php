<?php

namespace CXEngine\ExpertStats\Requests\Stats;

class UsersCallsRequest extends HostScopedStatsRequest
{
    protected function path(): string
    {
        return 'users-calls';
    }
}
