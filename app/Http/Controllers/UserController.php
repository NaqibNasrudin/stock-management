<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class UserController extends Controller
{
    public function index(){
        $user = Auth::user();

        $data['role'] = $user['role'];
        return view('manager.add_order', $data);
    }

    public function storeProduct(Request $request){
        $product = $request->input('product_name');
        $cust = $request->input('cust_name');
        $qty = $request->input('qty');

        $nameExplode = explode(" ",$cust);
        $randString =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,5);

        $code = $nameExplode[0].$randString;

        DB::insert('insert into products (product_name, code, cust_name, qty, status)
                    values (?, ?, ?, ?, ?)',
                    [$product, $code, $cust, $qty, 'New Order']);

        return redirect()->back()->with('message', 'Order '.$code.' Successfully Created.');
    }

    public function editProduct(Request $request){
        $status = $request->input('status');

        $productUpdate = array(
            'status' => $status
        );

        Product::where('id', $request->input('id'))->update($productUpdate);

        // echo $request->input('id');

        return redirect('/home');

    }

    public function productEdit(Request $request){
        $id = $request->input('id');

        $product = Product::where('id', $id)->first();

        $data['product'] = $product;

        exit(json_encode($data));
    }

    public function search(Request $request){
        $char = $request->input('char');

        $product = DB::table('Products')
                    ->where('product_name', 'LIKE', '%'.$char.'%')
                    ->orWhere('cust_name', 'LIKE', '%'.$char.'%')
                    ->orWhere('code', 'LIKE', '%'.$char.'%')
                    ->orWhere('status', 'LIKE', '%'.$char.'%')
                    ->get();

        $data['product'] = $product;

        exit(json_encode($data));

    }
}
