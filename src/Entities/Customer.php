<?php

namespace CXEngine\ExpertStats\Entities;

use Carbon\Carbon;
use CXEngine\ExpertStats\Entities\Entity;

class Customer extends Entity
{
    protected static $arrayCast = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function __construct(
        public ?string $code = null,
        public ?string $name = null,
        public ?string $tenant_code = null,
        public ?string $tenant_reference = null,
        public ?Carbon $created_at = null,
        public ?Carbon $updated_at = null,
    ) {
        //
    }
}
