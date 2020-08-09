<?php

namespace App;

use Abo3adel\ShoppingCart\Contracts\CanBeBought;
use Abo3adel\ShoppingCart\Traits\Buyable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements CanBeBought
{
    use Buyable;

    protected $casts = [
        'sizes' => 'array',
        'colors' => 'array',
    ];

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDiscount(): float
    {
        return $this->save;
    }
}
