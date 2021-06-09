<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index() {
    	$data['title'] = 'Admin Divisima | Product';
    	$data['subtitle'] = 'Data Products';
    	$data['products'] = Product::orderBy('id','desc')->paginate(10);
        return view('admin/product/list', $data);
    }

    public function insert() {
    	$data['title'] = 'Admin Divisima | Product';
    	$data['categories'] = Category::get();
    	return view('admin/product/insert', $data);	
    }

    public function insertAction(Request $request) {
    	$request->validate([
            'code' => 'required|unique:products',
        	'name' => 'required',
        	'stock' => 'required|integer',
            'price' => 'required|integer',
            'image' => 'required|max:2048'
        ]);
        $file = $request->file('image');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'data_file';
        if($file->move($tujuan_upload,$nama_file)){
            $data = Product::create([
                'code' => $request->code,
                'name' => $request->name,
                'stock' => $request->stock,
                'price' => $request->price,
                'image' => $nama_file
            ]);
        }
        $product = Product::get();

    	return back()->with('message','berhasil');
    }

    public function edit ($id) {
		$data['title'] = 'Admin Divisima | Product';
		$data['categories'] = Category::get();
		$data['product']= Product::find($id);
		return view('admin/product/edit', $data);
    }

    public function editAction (Request $request, $id) {
    	$validated = $request->validate([
        	'code' => 'required|unique:products',
        	'name' => 'required',
        	'stock' => 'required|integer',
        	'varian' => 'required',
        	'description' => 'required',
        	'category_id' => 'required',
    	]);

    	$code = $request->input('code');
    	$name = $request->input('name');
    	$stock = $request->input('stock');
    	$varian = $request->input('varian');
    	$description = $request->input('description');
    	$category_id = $request->input('category_id');

    	$product = Product::find($id);
        $product->code = $code;
    	$product->name = $name;
    	$product->stock = $stock;
    	$product->varian = $varian;
    	$product->description = $description;
    	$product->category_id = $category_id;
    	$product->save();

    	return back()->with('message','berhasil');
    }

    public function delete ($id) {
        $product = Product::find($id);
        $product->delete();
        return redirect('admin/product')->with('message','Data Berhasil DiHapus');
    }
}
