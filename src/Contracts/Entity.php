<?php

namespace CXEngine\ExpertStats\Contracts;

use Saloon\Http\Response;
use Illuminate\Support\Collection;

interface Entity
{
    public static function fromResponse(Response $response): Entity;

    public static function fromArray(array $data): Entity;

    public function toArray(bool $filter = false): array;

    public function toCollection(bool $filter = false): Collection;

    public function setResponse(Response $response): static;

    public function getResponse(): Response;
}
