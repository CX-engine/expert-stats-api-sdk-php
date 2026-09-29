<?php

namespace CXEngine\ExpertStats\Requests\Training;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Scores a fully-answered training, emails the certificate and returns the summary.
 */
class CompleteTrainingRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(
        protected readonly string $hostName,
        protected readonly array $data,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/'.$this->hostName.'/trainings/complete';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
