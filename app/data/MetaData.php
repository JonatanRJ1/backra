<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapName;

class MetaData extends Data
{
    public function __construct(
        public int $current_page,
        public int $per_page,
        public int $total,
        public int $last_page,
    ) {}
}