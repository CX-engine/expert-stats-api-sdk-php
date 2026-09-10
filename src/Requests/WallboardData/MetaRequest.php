<?php

namespace CXEngine\ExpertStats\Requests\WallboardData;

class MetaRequest extends WallboardDataRequest
{
    protected function path(): string
    {
        return 'meta';
    }
}
