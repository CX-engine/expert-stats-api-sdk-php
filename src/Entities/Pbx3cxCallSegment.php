<?php

namespace CXEngine\ExpertStats\Entities;

use Carbon\Carbon;
use CXEngine\ExpertStats\Entities\Entity;

class Pbx3cxCallSegment extends Entity
{
    protected static $arrayCast = [
        'start_at' => 'datetime:d/m/Y H:i:s',
        'answer_at' => 'datetime:d/m/Y H:i:s',
        'end_at' => 'datetime:d/m/Y H:i:s',
    ];

    protected static $aliases = [
        'start_time' => 'start_at',
        'end_time' => 'end_at',
        'seg_type' => 'segment_type',
    ];

    public function __construct(
        public ?int $call_id = null,
        public ?int $seg_id = null,
        public ?int $seg_type = null,
        public ?int $seg_order = null,
        public ?string $segment_type = null,
        public ?string $src_dn_type = null,
        public ?string $src_dn = null,
        public ?string $src_number = null,
        public ?string $src_display_name = null,
        public ?string $origin_dn_type = null,
        public ?string $origin_dn = null,
        public ?string $origin_display_name = null,
        public ?string $dst_dn_type = null,
        public ?string $dst_dn = null,
        public ?string $dst_number = null,
        public ?string $dst_display_name = null,
        public ?Carbon $start_at = null,
        public ?int $start_at_ts = null,
        public ?Carbon $answer_at = null,
        public ?int $answer_at_ts = null,
        public ?Carbon $end_at = null,
        public ?int $end_at_ts = null,
        public ?string $action = null,
        public ?int $segment_duration = null,
    ) {
        $this->segment_type = match ($this->segment_type) {
            '1' => 'ping',
            '2' => 'pong',
            default => $this->segment_type,
        };
    }
}
