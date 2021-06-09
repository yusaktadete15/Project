<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;



class OrderItemController extends Controller
{
    
    public function index($id) {
    	$data['title'] = 'Admin Divisima | Order';
    	$data['subtitle'] = 'Data Order Item';
    	// $data['orderitems'] = OrderItem::where('order_id',$id)->get();
    	$data['orderitems'] = DB::table('products')->leftjoin('order_items', 'products.id', '=', 'order_items.product_id')->select('order_items.id','order_id','products.name','quantity')->where('order_id',$id)->get();
    	$data['id'] = $id;
    	$data['product'] = DB::table('products')->get();
        return view('admin/order_item/list', $data);
    }

    public function insert(Request $request, $id) {
    	$validate = $request->validate([
    		'order_id' => 'required',
    		'product_id' => 'required',
    		'quantity' => 'required'
    	]);

    	// $order_id = $request->input('order_id');
    	// $product_id = $request->input('product_id');
    	// $quantity = $request->input('quantity');

		$orderitem = DB::table('order_items')->insertGetId(
			[
				'order_id' => $request->order_id,
				'product_id' => $request->product_id,
				'quantity' => $request->quantity
			]);

    	return back()->with('message','berhasil');

    }

    public function edit ($id) {
    	$data['title'] = 'Admin Divisima | Order Item';
    	$data['subtitle'] = 'Data Order Item';
    	$data['orderitem'] = DB::table('order_items')->leftjoin('products', 'order_items.product_id', '=', 'products.id')->select('order_items.id','order_id','products.name','quantity','product_id')->where('order_items.id',$id)->first();
		return view('admin/order_item/edit', $data);
    }

    public function editAction(Request $request, $id) {
    	$validate = $request->validate([
    		'order_id' => 'required',
    		'product_id' => 'required',
    		'quantity' => 'required'
    	]);

    	// $order_id = $request->input('order_id');
    	// $product_id = $request->input('product_id');
    	// $quantity = $request->input('quantity');

    	// $orderitem = OrderItem::find($id);
    	// $orderitem->order_id = $order_id;
    	// $orderitem->product_id = $product_id;
    	// $orderitem->quantity = $quantity;
    	// $orderitem->save();
    	// $id = $orderitem->order_id;

    	$orderitem = DB::table('order_items')->where('id',$request->id)->update(
			[
				'order_id' => $request->order_id,
				'product_id' => $request->product_id,
				'quantity' => $request->quantity
			]);
    	$id = $request->order_id;


    	return redirect('admin/order/orderItem/'.$id)->with('message', 'Berhasil');
    }

    public function delete ($id) {
        // $orderitem = OrderItem::find($id);
        // $orderitem->delete();

        DB::table('order_items')->where('id', $id)->delete();

        return back()->with('message','Data Berhasil DiHapus');
    }
}
