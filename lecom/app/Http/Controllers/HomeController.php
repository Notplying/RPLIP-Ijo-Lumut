<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;

use App\Models\Cart;

use App\Models\Order;

class HomeController extends Controller
{
    public function index(){
        $product=Product::paginate(9);

        if(Auth::id()){
            $usertype = Auth::User()->usertype;
            return view('home.userpage', compact('product', 'usertype'));
        } else {
            $usertype = 0;
            return view('home.userpage', compact('product', 'usertype'));
        }
        
    }

    public function redirect()
    {
        $usertype=Auth::user()->usertype;

        if($usertype=='1'){
            $username=Auth::user()->name;
            $total_product=Product::all()->count();
            $total_order=Order::all()->count();
            $total_user=User::all()->count();
            $order=Order::all();

            $total_rev=0;
            foreach($order as $o){
                $total_rev=$total_rev+$o->price;
            }

            $total_delivered=Order::where('delivery_status', '=', 'delivered')->get()->count();
            $total_processing=Order::where('delivery_status', '=', 'processing')->get()->count();

            return view('admin.home', compact('total_product', 'total_order', 'total_user', 'username', 'total_rev', 'total_delivered', 'total_processing'));
        }else{
            $product=Product::paginate(9);

            if(Auth::id()){
                $usertype = Auth::User()->usertype;
                return view('home.userpage', compact('product', 'usertype'));
            } else {
                $usertype = 0;
                return view('home.userpage', compact('product', 'usertype'));
            }
        }
    }

    public function product_details($id)
    {
        $product=Product::find($id);
		 if(Auth::id()){
            $usertype = Auth::User()->usertype;
            return view('home.product_details', compact('product', 'usertype'));
        } else {
            $usertype = 0;
            return view('home.product_details', compact('product', 'usertype'));
        }
    }

    public function add_cart(Request $request, $id){
        if(Auth::id()){
            $user=Auth::user();
            $product=Product::find($id);
            $cart=new Cart();
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->product_title=$product->title;
            if($product->discount_price != null){
                $cart->price=$product->discount_price * $request->quantity;
            } else {
                $cart->price=$product->price * $request->quantity;
            }
            $cart->image=$product->image;

            $cart->user_id=$user->id;
            $cart->product_id=$product->id;

            $cart->quantity=$request->quantity;

            $cart->save();
			$product->quantity = $product->quantity - $request->quantity;
			$product->save();
            return redirect()->back()->with('message', 'Item added to cart successfully');

        } else {
            return redirect('login');
        }
    }

    public function show_cart(){
        if(Auth::id()){
            $id=Auth::user()->id;

            $cart=Cart::where('user_id', '=', $id)->get();
            

            if(Auth::id()){
                $usertype = Auth::User()->usertype;
                return view('home.showcart', compact('cart', 'usertype'));
            } else {
                $usertype = 0;
                return view('home.showcart', compact('cart', 'usertype'));
            }
        } else{
            return redirect('login');
        }
        

    }

    public function remove_cart($id){
        $cart=Cart::find($id);
		$product=Product::find($id);
		$product->quantity = $product->quantity + $cart->quantity;
        $cart->delete();
		$product->save();
        return redirect()->back();
    }

    public function cash_order(){
        $id=Auth::user()->id;
        $cart=Cart::where('user_id', '=', $id)->get();
        foreach($cart as $c){
            $order=new Order();
            $order->user_id=$id;
            $order->name=$c->name;
            $order->email=$c->email;
            $order->phone=$c->phone;
            $order->address=$c->address;

            $order->product=$c->product_title;
            $order->quantity=$c->quantity;
            $order->price=$c->price;
            $order->image=$c->image;
            $order->product_id=$c->product_id;

            $order->payment_status='cash on delivery';
            $order->delivery_status='processing';

            $order->save();

            $c->delete();
        }




        return redirect()->back()->with('message', 'Your order has been placed successfully. Please wait for the confirmation');
    }

    public function show_order(){
        if(Auth::id()){
            $id=Auth::user()->id;
            $order=Order::where('user_id', '=', $id)->get();
            
            if(Auth::id()){
                $usertype = Auth::User()->usertype;
                return view('home.order', compact('order', 'usertype'));
            } else {
                $usertype = 0;
                return view('home.order', compact('order', 'usertype'));
            }
        } else {
            return redirect('login');
        }

    }

    public function cancel_order($id){
        $order=Order::find($id);
        $order->delivery_status='cancelled';
        $order->save();
        return redirect()->back();
    }

    public function product_search(Request $request){
        $searchtext=$request->search;
        $product=Product::where('title', 'LIKE', "%$searchtext%")->
        orWhere('category', 'LIKE', "%$searchtext%")->
        paginate(9);
        if(Auth::id()){
            $usertype = Auth::User()->usertype;
            return view('home.userpage', compact('product', 'usertype'));
        } else {
            $usertype = 0;
            return view('home.userpage', compact('product', 'usertype'));
        }
    }
}
