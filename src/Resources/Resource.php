<?php

namespace CXEngine\ExpertStats\Resources;

use CXEngine\ExpertStats\ExpertStatisticsConnector;

class Resource
{
    public function __construct(
        protected ExpertStatisticsConnector $connector
    ) {
        //
    }
}
