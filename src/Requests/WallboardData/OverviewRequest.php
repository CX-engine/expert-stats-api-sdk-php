<?php

namespace CXEngine\ExpertStats\Requests\WallboardData;

class OverviewRequest extends WallboardDataRequest
{
    protected function path(): string
    {
        return 'overview';
    }
}
