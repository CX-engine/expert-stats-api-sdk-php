<?php

namespace CXEngine\ExpertStats\Requests\Wallboard;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

class UpdateWallboardRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(
        protected readonly string $hostName,
        protected readonly string $uuid,
        protected readonly array $data,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/' . $this->hostName . '/wallboards/' . $this->uuid;
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
