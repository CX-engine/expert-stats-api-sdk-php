<?php

namespace CXEngine\ExpertStats\Requests\Training;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Summary (score, per-module results, every question with the selected and correct option) of a completed training. POST so the key travels in the body, not the URL.
 */
class ShowTrainingSummaryRequest extends Request implements HasBody
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
        return '/v1.2/'.$this->hostName.'/trainings/summary';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
