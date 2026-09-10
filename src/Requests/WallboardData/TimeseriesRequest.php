<?php

namespace CXEngine\ExpertStats\Requests\WallboardData;

class TimeseriesRequest extends WallboardDataRequest
{
    protected function path(): string
    {
        return 'timeseries';
    }
}
