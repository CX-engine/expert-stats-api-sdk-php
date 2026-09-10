<?php

namespace CXEngine\ExpertStats\Requests\AgentStats;

class DailyActivityRequest extends AgentStatsRequest
{
    protected function path(): string
    {
        return 'daily-activity';
    }
}
