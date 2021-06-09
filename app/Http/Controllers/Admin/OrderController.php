<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;



class OrderController extends Controller
{
    
    public function index() {
    	$data['title'] = 'Admin Divisima | Order';
    	$data['subtitle'] = 'Data Order';
    	// $data['orders'] = Order::orderBy('id','desc')->paginate(10);
        $data['orders'] = DB::table('orders')->leftjoin('users','orders.user_id', '=', 'users.id')->select('orders.id','users.name','tanggal_order')->orderby('orders.id','desc')->get();
        return view('admin/order/list', $data);
    }

    public function insert() {
    	$data['title'] = 'Admin Divisima | Order';
    	$data['users'] = DB::table('users')->get();
    	return view('admin/order/insert', $data);	
    }

    public function insertAction(Request $request) {
    	$validated = $request->validate([
    	'user_id' => 'required',
    	'tanggal_order' => 'required'
    	]);

    	// $user_id = $request->input('user_id');
    	// $tanggal_order = $request->input('tanggal_order');

    	// $order = new Order;
    	// $order->user_id = $user_id;
    	// $order->tanggal_order = $tanggal_order;
    	// $order->save();
    	// $id = $order->id;

        $id = DB::table('orders')->insertGetId(
            [
                'user_id' => $request->user_id,
                'tanggal_order' => $request->tanggal_order,
            ]);

    	return redirect('admin/order/orderItem/'.$id)->with('message', 'Berhasil');

    }

    public function delete ($id) {
        // $order = Order::find($id);
        // $order_item = OrderItem::where('order_id',$id)->delete();
        // $order->delete();

        DB::table('order_items')->where('order_id', $id)->delete();
        DB::table('orders')->where('id', $id)->delete();

        return redirect('admin/order')->with('message','Data Berhasil DiHapus');
    }

}
