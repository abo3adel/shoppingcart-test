<?php

use Abo3adel\ShoppingCart\CartItem;
use App\Product;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CartItem::class, 8)->create([
            'buyable_id' => (Product::all()->random())->id,
            'buyable_type' => Product::class,
            'instance' => Arr::random([
                'default',
                'wishlist',
                'compare'
            ])
        ]);
    }
}
