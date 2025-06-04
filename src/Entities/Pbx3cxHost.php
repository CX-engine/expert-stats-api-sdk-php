<?php

namespace CXEngine\ExpertStats\Entities;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use CXEngine\ExpertStats\Entities\Entity;
use CXEngine\ExpertStats\EntityCollection;

class Pbx3cxHost extends Entity
{
    protected static $arrayCast = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'licence_activation_date' => 'datetime',
        'licence_renewal_date' => 'datetime',
        'backups_fetched_at' => 'datetime',
        'cdr_fetched_at' => 'datetime',
        'cdr_pushed_at' => 'datetime',
        'csv_data_made_at' => 'datetime',
        'csv_data_fetched_at' => 'datetime',
        'recordings_fetched_at' => 'datetime',
        'recordings_pushed_at' => 'datetime',
        'expert_statistics_trial_ends_at' => 'datetime',
        'customers' => Casts\EntityCollectionCast::class.':'.Customer::class,
    ];

    public function __construct(
        public string $host_name,
        public ?string $code = null,
        public ?int $id = null,
        public bool $active = true,
        public ?string $customer_account = null,
        public ?int $customer_file_id = null,
        public ?int $port = null,
        public ?string $ip_address = null,
        public ?string $web_username = null,
        public ?string $web_password = null,
        public string $ssh_username = 'phonesystem',
        public ?string $ssh_password = null,
        public ?string $ssh_key = null,
        public string $database_name = 'database_single',
        public string $database_username = 'phonesystem',
        public ?string $database_password = null,
        public ?string $licence_key = null,
        public ?string $licence_type = null,
        public ?Carbon $licence_activation_date = null,
        public ?Carbon $licence_renewal_date = null,
        public ?string $sbc_aliases = null,
        public string $backups_location = '/var/lib/3cxpbx/Instance1/Data/Backups',
        public bool $fetch_backups = true,
        public ?Carbon $backups_fetched_at = null,
        public int $backups_frequency = 1440,
        public ?string $backups_host = null,
        public ?string $backups_host_username = null,
        public ?string $backups_host_password = null,
        public string $cdr_location = '/var/lib/3cxpbx/Instance1/Data/Logs/CDRLogs',
        public bool $fetch_cdr = false,
        public bool $push_cdr = false,
        public ?Carbon $cdr_fetched_at = null,
        public ?Carbon $cdr_pushed_at = null,
        public int $cdr_frequency = 1440,
        public string $csv_location = '/var/lib/3cxpbx/Instance1/Data/Logs/Tmp',
        public ?bool $fetch_pbx_fetch_again = false,
        public ?array $pbx_map = null,
        public ?string $groups = null,
        public ?Carbon $expert_statistics_trial_ends_at = null,
        public ?bool $expert_statistics_active_subscription = false,
        public ?string $expert_statistics_version = '1.00',
        public ?int $pbx3cx_host_grid_id = null,
        public bool $make_csv_data = false,
        public int $make_csv_data_back_in_months = 12,
        public ?Carbon $csv_data_made_at = null,
        public bool $fetch_csv_data = false,
        public ?Carbon $csv_data_fetched_at = null,
        public int $last_call_id = 0,
        public int $last_party_info_id = 0,
        public int $csv_data_frequency = 1440,
        public bool $cl_calls_is_sync = true,
        public bool $cl_participants_is_sync = true,
        public bool $cl_party_info_is_sync = true,
        public bool $cl_segments_is_sync = true,
        public string $recordings_location = '/var/lib/3cxpbx/Instance1/Data/Recordings',
        public bool $fetch_recordings = false,
        public ?Carbon $recordings_fetched_at = null,
        public bool $push_recordings = false,
        public ?Carbon $recordings_pushed_at = null,
        public int $recordings_frequency = 1440,
        public ?string $comment = null,
        public ?Carbon $created_at = null,
        public ?Carbon $updated_at = null,
        public ?EntityCollection $customers = null,
    ) {
        //
    }

    public function toRequestPayload(): array
    {
        return [
            ...Arr::except(
                $this->toArray(),
                ['code', 'pbx_map', 'customers', 'created_at', 'updated_at']
            ),
            ...array_filter([
                'licence_activation_date' => $this->licence_activation_date ? $this->licence_activation_date->format('Y-m-d\TH:i:sZ') : null,
                'licence_renewal_date' => $this->licence_renewal_date ? $this->licence_renewal_date->format('Y-m-d\TH:i:sZ') : null,
                'backups_fetched_at' => $this->backups_fetched_at ? $this->backups_fetched_at->format('Y-m-d\TH:i:sZ') : null,
                'cdr_fetched_at' => $this->cdr_fetched_at ? $this->cdr_fetched_at->format('Y-m-d\TH:i:sZ') : null,
                'cdr_pushed_at' => $this->cdr_pushed_at ? $this->cdr_pushed_at->format('Y-m-d\TH:i:sZ') : null,
                'expert_statistics_trial_ends_at' => $this->expert_statistics_trial_ends_at ? $this->expert_statistics_trial_ends_at->format('Y-m-d\TH:i:sZ') : null,
                'csv_data_made_at' => $this->csv_data_made_at ? $this->csv_data_made_at->format('Y-m-d\TH:i:sZ') : null,
                'csv_data_fetched_at' => $this->csv_data_fetched_at ? $this->csv_data_fetched_at->format('Y-m-d\TH:i:sZ') : null,
                'recordings_fetched_at' => $this->recordings_fetched_at ? $this->recordings_fetched_at->format('Y-m-d\TH:i:sZ') : null,
                'recordings_pushed_at' => $this->recordings_pushed_at ? $this->recordings_pushed_at->format('Y-m-d\TH:i:sZ') : null,
            ])
        ];
    }
}
