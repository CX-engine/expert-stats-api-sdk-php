<?php

namespace CXEngine\ExpertStats\Requests\Stats;

/**
 * Hourly external outbound calls placed by users (`dn` optional), in the same
 * row shape as {@see OutboundCallsRequest}.
 */
class UsersOutboundCallsRequest extends HostScopedStatsRequest
{
    protected function path(): string
    {
        return 'users-outbound-calls';
    }
}
