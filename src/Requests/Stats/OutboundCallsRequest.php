<?php

namespace CXEngine\ExpertStats\Requests\Stats;

class OutboundCallsRequest extends HostScopedStatsRequest
{
    protected function path(): string
    {
        return 'outbound-calls';
    }
}
