<?php

namespace CXEngine\ExpertStats\Entities\Concerns;

use Carbon\Carbon;
use ReflectionClass;
use Carbon\CarbonInterval;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use CXEngine\ExpertStats\Contracts\CastsAttributes;
use CXEngine\ExpertStats\Exceptions\InvalidCastException;
use CXEngine\ExpertStats\Contracts\Entity as EntityContract;

trait CastArrayValues
{
    /**
     * The attributes that should be cast when created from an array.
     *
     * @var array
     */
    protected static $arrayCast = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function getDefinedCastAttributes(): array
    {
        return static::$arrayCast ?? [];
    }

    public static function getCastAttributes(): array
    {
        return [
            ...static::getConstructorParameterTypes(),
            ...static::getDefinedCastAttributes(),
        ];
    }

    public static function getCastNamesAttributes(): array
    {
        return static::parseCastNamesFromTypes(
            static::getCastAttributes()
        );
    }

    public static function castArrayValues(array &$values, ?array $cast = null)
    {
        $types = static::getCastAttributes();
        $cast = $cast ?: static::getCastNamesAttributes();

        foreach ($values as $key => $value) {
            if (is_null($value) || !array_key_exists($key, $cast)) {
                continue;
            }

            if ($cast[$key] === 'cast') {
                $castConfiguration = explode(':', $types[$key]);
                $castClass = $castConfiguration[0];
                $castParameters = explode(',', $castConfiguration[1] ?? '');
            }

            if ($cast[$key] === 'datetime' && filled($value) && strpos($types[$key], ':') !== false) {
                $format = Str::after($types[$key], ':');
                $value = Carbon::createFromFormat($format, $value);
            }

            $values[$key] = match ($cast[$key]) {
                'null' => null,
                'int', 'integer' => (int) $value,
                'float' => (float) $value,
                'bool', 'boolean' => (bool) $value,
                'string' => (string) $value,
                'array' => (array) $value,
                'object' => (object) $value,
                'collection' => (array) $value,
                'entity' => $value ? $types[$key]::fromArray($value) : null,
                'enum' => $value ? $types[$key]::from($value) : null,
                'cast' => $value ? $castClass::from($value, ...$castParameters) : null,
                'date', 'datetime', 'carbon' => is_a($value, Carbon::class) ? $value : Carbon::parse($value),
                'interval', 'carbon_interval' => is_a($value, CarbonInterval::class) ? $value : ($value === '00:00:00' ? null : CarbonInterval::fromString($value)),
                default => throw new InvalidCastException(
                    'Invalid cast type `' . $cast[$key] . '` for key `' . $key . '`.'
                ),
            };
        }
    }

    public static function guessCastFromClassName(string $className): ?string
    {
        return match ($className) {
            Carbon::class => 'carbon',
            CarbonInterval::class => 'carbon_interval',
            EntityContract::class => 'entity',
            CastsAttributes::class => 'cast',
            Collection::class => 'collection',
            default => null,
        };
    }

    public static function getConstructorParameterTypes(): array
    {
        $reflector = new ReflectionClass(static::class);
        $constructor = $reflector->getConstructor();
        $params = [];

        if ($constructor) {
            foreach ($constructor->getParameters() as $parameter) {
                $paramType = $parameter->getType();
                if ($paramType) {
                    $params[$parameter->getName()] = $paramType->getName();
                }
            }
        }

        return $params;
    }

    public static function parseCastNamesFromTypes(array $types): array
    {
        return collect($types)
            ->mapWithKeys(function ($type, $name) {
                if (strpos($type, ':') !== false) {
                    [$type,] = explode(':', $type);
                }

                if (enum_exists($type)) {
                    return [$name => 'enum'];
                }

                if (class_exists($type)) {
                    $implements = class_implements($type) ?: [];

                    foreach ([$type, ...$implements] as $class) {
                        if ($cast = static::guessCastFromClassName($class)) {
                            return [$name => $cast];
                        }
                    }
                }

                return [$name => $type];
            })
            ->filter()
            ->toArray();
    }
}
