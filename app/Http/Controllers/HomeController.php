<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['products'] = Product::get();
        $data['latests'] = Product::orderByDesc('id')
                                    ->take(5)
                                    ->get();
        return view('home', $data);
    }

    public function home()
    {
        return view('admin.template');
    }
}
