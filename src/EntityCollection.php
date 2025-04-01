<?php

namespace CXEngine\ExpertStats;

use Saloon\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class EntityCollection extends Collection
{
    public static function fromArray(array $data, string $dtoClass, $pathKey = null): static
    {
        $data = $pathKey ? Arr::get($data, $pathKey, []) : $data;

        $elements = collect($data)
            ->filter()
            ->map(fn (array $el) => $dtoClass::fromArray($el));

        return new static($elements);
    }

    public static function tryFromArray(array $data, string $dtoClass, $pathKey = null): static
    {
        $data = $pathKey ? Arr::get($data, $pathKey, []) : $data;

        $elements = collect($data)
            ->filter()
            ->map(fn (array $el) => $dtoClass::tryFromArray($el));

        return new static($elements);
    }

    public static function fromResponse(Response $response, string $dtoClass, $pathKey = null): static
    {
        $elements = $response
            ->collect($pathKey)
            ->filter()
            ->map(fn (array $el) => $dtoClass::fromArray($el));

        return new static($elements);
    }

    public static function tryFromResponse(Response $response, string $dtoClass, $pathKey = null): static
    {
        $elements = $response
            ->collect($pathKey)
            ->filter()
            ->map(fn (array $el) => $dtoClass::tryFromArray($el))
            ->filter();

        return new static($elements);
    }
}
