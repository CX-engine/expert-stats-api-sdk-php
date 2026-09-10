<?php

namespace CXEngine\ExpertStats\Requests\Ai\Reports;

use Saloon\Enums\Method;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use CXEngine\ExpertStats\Requests\Ai\AiRequest;

class StoreReportRequest extends AiRequest implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(
        string $hostName,
        protected readonly array $data,
    ) {
        parent::__construct($hostName);
    }

    protected function path(): string
    {
        return 'reports';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
