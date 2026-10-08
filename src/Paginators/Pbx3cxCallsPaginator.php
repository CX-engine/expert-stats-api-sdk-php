<?php

namespace CXEngine\ExpertStats\Paginators;

use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\CursorPaginator;

/**
 * Walks the keyset-paginated v1.3 calls endpoint.
 *
 * A failed page ends the iteration instead of looping on it; the failed response is still
 * yielded, so callers iterating responses can detect and report it.
 */
class Pbx3cxCallsPaginator extends CursorPaginator
{
    protected ?int $perPageLimit = 250;

    protected function getNextCursor(Response $response): int|string
    {
        return $response->json('next_cursor');
    }

    protected function isLastPage(Response $response): bool
    {
        return $response->failed() || is_null($response->json('next_cursor'));
    }

    protected function getPageItems(Response $response, Request $request): array
    {
        return $response->failed() ? [] : $response->dto()->all();
    }
}
