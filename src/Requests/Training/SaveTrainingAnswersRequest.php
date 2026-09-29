<?php

namespace CXEngine\ExpertStats\Requests\Training;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Upserts answers (`answers`: [{question_id, option_id}]) of an in-progress training.
 */
class SaveTrainingAnswersRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

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
        return '/v1.2/'.$this->hostName.'/trainings/answers';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
