<?php

namespace CXEngine\ExpertStats\Entities\Casts;

use Illuminate\Support\Str;
use CXEngine\ExpertStats\EntityCollection;
use CXEngine\ExpertStats\Contracts\CastsAttributes;

class EntityCollectionCast implements CastsAttributes
{
    public static function from($from, $entityClass, $path = null): EntityCollection
    {
        if ($from instanceof EntityCollection) {
            return $from;
        }

        if ($path) {
            $from = data_get($from, Str::start($path, '*.'));
        }

        return EntityCollection::fromArray($from, $entityClass);
    }

    public static function tryFrom($from, $class, $path = null): ?EntityCollection
    {
        try {
            return static::from($from, $class, $path);
        } catch (\Throwable $th) {
            return null;
        }
    }
}
