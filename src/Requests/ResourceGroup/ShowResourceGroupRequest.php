<?php

namespace CXEngine\ExpertStats\Requests\ResourceGroup;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ShowResourceGroupRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected readonly string $hostName,
        protected readonly int $id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/' . $this->hostName . '/resource-groups/' . $this->id;
    }
}
