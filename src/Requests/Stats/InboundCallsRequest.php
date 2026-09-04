<?php

namespace CXEngine\ExpertStats\Requests\Stats;

class InboundCallsRequest extends HostScopedStatsRequest
{
    /**
     * @param  array<string, mixed>  $query
     */
    public function __construct(
        string $hostName,
        protected readonly string $type,
        array $query = [],
        protected readonly bool $preAnswer = false,
    ) {
        parent::__construct($hostName, $query);
    }

    protected function path(): string
    {
        $segment = $this->preAnswer ? 'inbound-calls-preanswer' : 'inbound-calls';

        return "{$segment}/{$this->type}";
    }
}
