<?php

namespace CXEngine\ExpertStats\Requests\WallboardData;

class HasDataRequest extends WallboardDataRequest
{
    protected function path(): string
    {
        return 'has-data';
    }
}
