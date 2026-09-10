<?php

namespace CXEngine\ExpertStats\Requests\WallboardData;

class CallsRequest extends WallboardDataRequest
{
    protected function path(): string
    {
        return 'calls';
    }
}
