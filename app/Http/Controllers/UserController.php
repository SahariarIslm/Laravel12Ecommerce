<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\Order;

class UserController extends Controller
{
    public function index(){
        if(Auth::check()){
            $count = ProductCart::where('user_id',Auth::id())->count();
        }else{
            $count='';
        }
        if(Auth::check() && Auth::user()->user_type=="user"){
            return view('dashboard',compact('count'));
        }else if(Auth::check() && Auth::user()->user_type=="admin"){
            return view('admin.dashboard');
        }
    }
    public function home(){
        if(Auth::check()){
            $count = ProductCart::where('user_id',Auth::id())->count();
        }else{
            $count='';
        }
        $products = Product::latest()->take(4)->get();
        return view('index',compact('products','count'));
    }
    public function productDetails($id){
        if(Auth::check()){
            $count = ProductCart::where('user_id',Auth::id())->count();
        }else{
            $count='';
        }
        // $product = Product::findOrFail($id);
        $product = Product::findOrFail($id);
        return view('productDetails',compact('product','count'));
    }
    public function allProducts(){
        if(Auth::check()){
            $count = ProductCart::where('user_id',Auth::id())->count();
        }else{
            $count='';
        }
        $products = Product::all();
        return view('allproducts',compact('products','count'));
    }
    public function addToCart($id){
        $product = Product::findOrFail($id);
        $product_cart = new ProductCart();
        $product_cart->user_id = Auth::id();
        $product_cart->product_id = $product->id;

        $product_cart->save();
        return redirect()->back()->with('cart_message','added to the cart');
    }
    public function cartproducts(){
        if(Auth::check()){
            $count = ProductCart::where('user_id',Auth::id())->count();
            $cart = ProductCart::where('user_id',Auth::id())->get();
        }else{
            $count='';
            $cart='';
        }
        return view('viewcartproducts',compact('count','cart'));
    }
    public function removeCartProduct($id){
        $cart = ProductCart::findOrFail($id);
        $cart->delete();
        return redirect()->back()->with('cart_message','removed from the cart');
    }
    public function confirmOrder(Request $request){
        $cart_user_id = ProductCart::where('user_id',Auth::id())->get();
        $address=$request->receiver_address;
        $phone=$request->receiver_phone_number;
        foreach($cart_user_id as $cart_product){
            $order = new Order();
            $order->receiver_address = $address;
            $order->receiver_phone_number = $phone;
            $order->user_id = Auth::id();
            $order->product_id = $cart_product->product_id;
            $order->save();
        }
        $carts = ProductCart::where('user_id',Auth::id())->get();
        foreach($carts as $cart){
            $cart_id = ProductCart::findOrFail($cart->id);
            $cart_id->delete();
        }
        return redirect()->back()->with('confirm_order','order places successfully');
    }
    public function myOrders(){
        $orders = Order::where('user_id',Auth::id())->get();
        return view('viewmyorders',compact('orders'));
    }
}