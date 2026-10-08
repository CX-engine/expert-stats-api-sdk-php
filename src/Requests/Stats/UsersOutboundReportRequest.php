<?php

namespace CXEngine\ExpertStats\Requests\Stats;

/**
 * Per-user external outbound calls (internal calls are never counted), plus
 * the totals across the requested users.
 */
class UsersOutboundReportRequest extends HostScopedStatsRequest
{
    protected function path(): string
    {
        return 'users-outbound-report';
    }
}
