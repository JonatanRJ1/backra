<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class GenericResponseData extends Data
{
    public function __construct(
        public bool $status,
        public string $message,
        public int $code, 
        public ?string $error = null,
        public mixed $data = null,
    ) {}
}