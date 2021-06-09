<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = OrderItem::with('product')->where('order_id', $id)->get();

        return response()->json(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
    		'order_id' => 'required|integer|exists:orders,id',
    		'product_id' => 'required|integer|exists:products,id',
    		'quantity' => 'required|integer'
    	]);

        $data = $request->all();
        OrderItem::create($data);
        $orderitem = OrderItem::with('product')->where('order_id', $data['order_id'])->get();

    	return response()->json(['data' => $orderitem]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $order_id, $id)
    {
        $request->validate([
    		'order_id' => 'required|integer|exists:orders,id',
    		'product_id' => 'required|integer|exists:products,id',
    		'quantity' => 'required|integer'
    	]);

        $data = $request->all();
        OrderItem::where('order_id', $data['order_id'])->where('id', $id)->update(
            [
                'order_id' => $data['order_id'],
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity']
            ]
            );
        $orderitem = OrderItem::with('product')->where('order_id', $data['order_id'])->get();

    	return response()->json(['data' => $orderitem]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($order_id, $id)
    {
        OrderItem::where('order_id', $order_id)->where('id', $id)->delete();
        $orderitem = OrderItem::with('product')->where('order_id', $order_id)->get();

        return response()->json(['data' => $orderitem]);
    }

    public function search($nama)
    {
        $orderitem = DB::table('order_items')
        ->leftjoin('products', 'order_items.product_id', '=', 'products.id')
        ->select('order_items.id','order_id','products.name','quantity','product_id')
        ->where('products.name', 'LIKE', "%{$nama}%")
        ->get();

        return response()->json(['data' => $orderitem]);
    }
}
