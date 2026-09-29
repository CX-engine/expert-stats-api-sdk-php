<?php

namespace CXEngine\ExpertStats\Requests\Training;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Creates a training and emails its key to `email`. The key is never returned - the caller must have checked that `email` was invited to `tenant_id` beforehand.
 */
class StoreTrainingRequest extends Request implements HasBody
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
        return '/v1.2/'.$this->hostName.'/trainings';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
