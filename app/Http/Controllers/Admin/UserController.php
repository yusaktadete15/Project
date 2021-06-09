<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {	
    	$data['title'] = 'Admin Divisima | User';
    	$data['subtitle'] = 'Data User';
    	$data['users'] = User::paginate(5);
        return view('admin/user/list',$data);
    }

    public function insert() {
    	$data['title'] = 'Admin Divisima | User';
    	return view('admin/user/insert', $data);	
    }

    public function insertAction(Request $request) {
    	$validated = $request->validate([
        	'name' => 'required',
        	'email' => 'required',
        	'password' => 'required',
    	]);

    	$name = $request->input('name');
    	$email = $request->input('email');
    	$password = $request->input('password');

    	$user = new User;
    	$user->name = $name;
    	$user->email = $email;
    	$user->password = $password;
    	$user->save();

    	return back()->with('message','berhasil');


    }

    public function edit ($id) {
        $data['title'] = 'Admin Divisima | User';
        $data['user']= User::find($id);
        return view('admin/user/edit', $data);
    }

    public function editAction(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::find($id);
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->save();

        return back()->with('message','berhasil');
    }
    public function delete ($id) {
        $user = User::find($id);
        $user->delete();

        return redirect('admin/user')->with('message','Data Berhasil DiHapus');
    }
}
