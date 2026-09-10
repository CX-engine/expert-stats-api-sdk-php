<?php

namespace CXEngine\ExpertStats\Requests\AgentStats;

class QueueCoverageUsersRequest extends AgentStatsRequest
{
    protected function path(): string
    {
        return 'queue-coverage/users';
    }
}
