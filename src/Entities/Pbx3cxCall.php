<?php

namespace CXEngine\ExpertStats\Entities;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Arr;
use CXEngine\ExpertStats\Entities\Entity;
use CXEngine\ExpertStats\EntityCollection;

class Pbx3cxCall extends Entity
{
    protected static $arrayCast = [
        'call_start' => 'datetime:Y-m-d H:i:s',
        'call_end' => 'datetime:Y-m-d H:i:s',
        'answer_at' => 'datetime:Y-m-d H:i:s',
        'end_at' => 'datetime:Y-m-d H:i:s',
        'ringing_duration' => 'interval',
        'talking_duration' => 'interval',
        'segments' => Casts\EntityCollectionCast::class.':'.Pbx3cxCallSegment::class,
    ];

    public function __construct(
        public ?string $host = null,
        public ?string $call_id = null,
        public ?string $call_way = null,
        public ?Carbon $call_start = null,
        public ?int $call_start_ts = null,
        public ?Carbon $call_end = null,
        public ?int $call_end_ts = null,
        public ?string $caller_number = null,
        public ?string $did_number = null,
        public ?CarbonInterval $ringing_duration = null,
        public ?CarbonInterval $talking_duration = null,
        public ?string $origin_dn_type = null,
        public ?string $origin_dn = null,
        public ?string $origin_display_name = null,
        public ?string $dst_dn_type = null,
        public ?string $dst_dn = null,
        public ?string $dst_number = null, # deprecated
        public ?string $dst_display_name = null,
        public ?Carbon $answer_at = null,
        public ?int $answer_at_ts = null,
        public ?Carbon $end_at = null,
        public ?int $end_at_ts = null,
        public ?string $segment_type = null,
        public ?string $action = null, # deprecated
        public ?int $segment_duration = null,
        public ?bool $is_answered = null,
        public ?bool $is_outbound_segment = null,
        public ?EntityCollection $segments = null,
    ) {
        //
    }

    public static function fromArray(array $data): static
    {
        $data = [
            ...Arr::get($data, 'call', $data),
            'segments' => Arr::get($data, 'segments', []),
        ];

        return parent::fromArray($data);
    }
}
