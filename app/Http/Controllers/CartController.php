<?php

namespace App\Http\Controllers;

use Abo3adel\ShoppingCart\Exceptions\ItemAlreadyExistsException;
use App\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'all' => Cart::instance()->content(),
            'wish' => Cart::instance('wishlist')->content(),
            'cmp' => Cart::instance('compare')->content(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        try {
            return response()->json(
                Cart::instance(
                    $request->get('instance')
                )->add($product, 1, 0, 0),
                201
            );
        } catch (ItemAlreadyExistsException $e) {
            return response()->noContent();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
