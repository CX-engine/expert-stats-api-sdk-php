<?php

namespace CXEngine\ExpertStats\Requests\HostNote;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

class UpdateHostNoteRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(
        protected readonly string $hostName,
        protected readonly int $id,
        protected readonly array $data,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/' . $this->hostName . '/pbx3cx-notes/' . $this->id;
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
