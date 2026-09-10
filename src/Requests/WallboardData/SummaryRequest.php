<?php

namespace CXEngine\ExpertStats\Requests\WallboardData;

class SummaryRequest extends WallboardDataRequest
{
    protected function path(): string
    {
        return 'summary';
    }
}
