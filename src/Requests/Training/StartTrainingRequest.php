<?php

namespace CXEngine\ExpertStats\Requests\Training;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Unlocks a training with its emailed key + email, returning its questions (without the correct answers) and any saved answers - or the summary if it's already completed.
 */
class StartTrainingRequest extends Request implements HasBody
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
        return '/v1.2/'.$this->hostName.'/trainings/start';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
