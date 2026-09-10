<?php

namespace CXEngine\ExpertStats\Requests\Cdr;

use CXEngine\ExpertStats\Requests\Stats\HostScopedStatsRequest;

/**
 * Streams a binary xlsx export - the response must NOT be `->json()`'d by
 * callers, see {@see \CXEngine\ExpertStats\Resources\CdrResource::export()}.
 */
class CdrExportRequest extends HostScopedStatsRequest
{
    protected function path(): string
    {
        return 'cdr-report/export';
    }
}
