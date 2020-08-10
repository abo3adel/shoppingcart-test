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
            'all' => Cart::instance()->content()->values(),
            'wish' => Cart::instance('wishlist')->content()->values(),
            'cmp' => Cart::instance('compare')->content()->values(),
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
        ['instance' => $instance] = request()->validate([
            'instance' => 'required|alpha|min:7|max:8',
        ]);
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
        [
            'type' => $type,
            'instance' => $instance
        ] = request()->validate([
            'type' => 'required|alpha|min:3|max:3',
            'instance' => 'required|alpha|min:7|max:8',
        ]);

        $item = Cart::instance(
            $instance
        )->find($id);

        if ($type === 'add') {
            return response()->json(
                [],
                $item->increments() ? 204 : 200
            );
        }

        return  response()->json(
            [],
            $item->decrements() ? 204 : 200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instance = request()->validate([
            'data.instance' => 'required|alpha|min:7|max:8',
        ]);
        $instance = $instance['data']['instance'];

        Cart::instance($instance)->delete($id);

        return response()->noContent();
    }
}
