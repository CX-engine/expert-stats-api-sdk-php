<?php

namespace CXEngine\ExpertStats\Requests\Wallboard;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

/**
 * The backend validates `{"active": bool}` on this endpoint
 * (`WallboardConfigController::setActive()`) — the body is required, not
 * optional, or the request 422s.
 */
class SetActiveWallboardRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected readonly string $hostName,
        protected readonly string $uuid,
        protected readonly bool $active = true,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/' . $this->hostName . '/wallboards/' . $this->uuid . '/active';
    }

    protected function defaultBody(): array
    {
        return ['active' => $this->active];
    }
}
