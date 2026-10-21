<?php

namespace CXEngine\ExpertStats\Requests\ConfigAudit;

class ShowRouteRequest extends ConfigAuditRequest
{
    /**
     * @param  array<string, mixed>  $queryParams
     */
    public function __construct(
        string $hostName,
        protected readonly string $did,
        array $queryParams = [],
    ) {
        parent::__construct($hostName, $queryParams);
    }

    protected function path(): string
    {
        return 'routes/'.rawurlencode($this->did);
    }
}
