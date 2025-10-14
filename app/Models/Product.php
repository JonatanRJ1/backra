<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{

    use Searchable;

    protected $table = 'products';

    protected $fillable = [
        'name', 
        'description', 
        'price',
        'stock',
        'sku',
        'created_at',
        'updated_at'
    ];
}
