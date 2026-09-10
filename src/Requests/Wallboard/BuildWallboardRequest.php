<?php

namespace CXEngine\ExpertStats\Requests\Wallboard;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

/**
 * AI-generates a wallboard layout - this can take noticeably longer than the
 * connector's default 60s timeout, so it overrides the request-level timeout
 * (merged over the connector's {@see \CXEngine\ExpertStats\ExpertStatisticsConnector::defaultConfig()}).
 */
class BuildWallboardRequest extends Request implements HasBody
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
        return '/v1.2/' . $this->hostName . '/wallboards/build';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    protected function defaultConfig(): array
    {
        return [
            'timeout' => 130,
        ];
    }
}
