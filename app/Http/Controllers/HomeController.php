<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $product = Product::all();

        $data['role'] = $user['role'];
        $data['product'] = $product;

        // if ($user['role'] == 'Admin') {
            return view('manager.manager_home', $data);
        // }
        // return view('user.user_home', $data);

        // var_dump($data);
        // return view('home');
    }
}
