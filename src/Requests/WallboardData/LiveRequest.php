<?php

namespace CXEngine\ExpertStats\Requests\WallboardData;

class LiveRequest extends WallboardDataRequest
{
    protected function path(): string
    {
        return 'live';
    }
}
