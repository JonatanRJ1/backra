<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapName;
use App\Data\MetaData;

class ProductData extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $description,
        public float $price,
        public int $stock,
        public string $sku,
        public ?string $created_at,
        public ?string $updated_at,
    ) {}
}