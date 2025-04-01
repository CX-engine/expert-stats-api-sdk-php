<?php

namespace CXEngine\ExpertStats;

use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Http\Connector;
use Saloon\Http\Auth\TokenAuthenticator;
use CXEngine\ExpertStats\Resources;
use Saloon\PaginationPlugin\PagedPaginator;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use CXEngine\ExpertStats\Requests\AuthRequest;
use CXEngine\ExpertStats\Exceptions\AuthenticationException;

class ExpertStatisticsConnector extends Connector implements HasPagination
{
    protected string $apiToken;
    protected array $apiUser;

    public function __construct(
        protected string $apiUrl,
        #[\SensitiveParameter]
        protected string $email,
        #[\SensitiveParameter]
        protected string $password,
    ) {
        $this->setAccessToken();
    }

    protected function setAccessToken()
    {
        $response = $this->send(
            new AuthRequest($this->email, $this->password)
        );

        if ($response->failed()) {
            throw new AuthenticationException(
                'Failed to authenticate with Expert Statistics API. Please check your credentials.'
            );
        }

        $body = $response->json();

        $this->apiUser = $body['user'];
        $this->apiToken = $body['token'];

        $this->authenticate(new TokenAuthenticator($this->apiToken));
    }

    public function resolveBaseUrl(): string
    {
        return $this->apiUrl;
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function paginate(Request $request): PagedPaginator
    {
        return new class(connector: $this, request: $request) extends PagedPaginator {
            protected ?int $perPageLimit = 20;

            protected function isLastPage(Response $response): bool
            {
                return is_null($response->json('next_page_url'));
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->dto()->all();
            }
        };
    }

    public function pbx3cxHost(): Resources\Pbx3cxHostResource
    {
        return new Resources\Pbx3cxHostResource($this);
    }

    public function pbx3cxCall(): Resources\Pbx3cxCallResource
    {
        return new Resources\Pbx3cxCallResource($this);
    }
}
