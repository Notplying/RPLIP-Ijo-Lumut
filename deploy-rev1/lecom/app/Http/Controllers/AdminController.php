<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Category;

use App\Models\Product;

use App\Models\Order;

class AdminController extends Controller
{
    public function view_category(){
        if(Auth::id() && (Auth::User()->usertype == 1)){
        $data=category::all();
        $username=Auth::user()->name;
        return view('admin.category', compact('data', 'username'));
        }else{
            $product=Product::paginate(9);
            return view('home.userpage', compact('product'));
            
        }
    }

    public function add_category(Request $request){
        if(Auth::id() && (Auth::User()->usertype == 1)){
        $data = new category;
        $data->category_name = $request->category;
        $data->save();

        return redirect()->back()->with('message','Category Added Successfully');
        }else{
            $product=Product::paginate(9);
            return view('home.userpage', compact('product'));
        }
    }

    public function delete_category($id){
        if(Auth::id() && (Auth::User()->usertype == 1)){
        $data=category::find($id);
        $data->delete();

        return redirect()->back()->with('message','Category Deleted Successfully');
        }else{
            $product=Product::paginate(9);
            return view('home.userpage', compact('product'));
        }
    }

    public function view_product(){
        if(Auth::id() && (Auth::User()->usertype == 1)){
        $category=category::all();
        $username=Auth::user()->name;
        return view('admin.product', compact('category', 'username'));
        }else{
            $product=Product::paginate(9);
            return view('home.userpage', compact('product'));
        }
    }

    public function add_product(Request $request){
        if(Auth::id() && (Auth::User()->usertype == 1)){
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;
        
        if ($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time().'.'.$extension;
            $file->move('product_image', $filename);
            $product->image = $filename;
        }
        // $image=$request->img;

        // $imagename=time().'.'.$image->getClientOriginalExtension();
        // $request->$image->move('product_image' , $imagename);
        // $product->image = $imagename;
        $product->save();

        return redirect()->back()->with('message','Product Added Successfully');
        }else{
            $product=Product::paginate(9);
            return view('home.userpage', compact('product'));
        }
    }

    public function show_product(){
        if(Auth::id() && (Auth::User()->usertype == 1)){
        $product=Product::all();
        $username=Auth::user()->name;
        return view('admin.show_product', compact('product', 'username'));
        }else{
            $product=Product::paginate(9);
            return view('home.userpage', compact('product'));
        }
    }

    public function delete_product($id){
        if(Auth::id() && (Auth::User()->usertype == 1)){
        $product=Product::find($id);
        $product->delete();

        return redirect()->back()->with('message','Product Deleted Successfully');
        }else{
            $product=Product::paginate(9);
            return view('home.userpage', compact('product'));
        }
    }

    public function edit_product($id){
        if(Auth::id() && (Auth::User()->usertype == 1)){
        $product=Product::find($id);
        $category=category::all();
        $username=Auth::user()->name;
        return view('admin.edit_product', compact('product', 'category', 'username'));
        }else{
            $product=Product::paginate(9);
            return view('home.userpage', compact('product'));
        }
    }

    public function edit_product_confirm(Request $request, $id){
        if(Auth::id() && (Auth::User()->usertype == 1)){
        $product=Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;

        if ($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time().'.'.$extension;
            $file->move('product_image', $filename);
            $product->image = $filename;
        }

        $product->save();
        return redirect()->back()->with('message','Product Edited Successfully');
        }else{
            $product=Product::paginate(9);
            return view('home.userpage', compact('product'));
        }
    }

    public function order(){
        if(Auth::id() && (Auth::User()->usertype == 1)){
        $order=Order::all();
        $username=Auth::user()->name;
        return view('admin.order', compact('order', 'username'));
        }else{
            $product=Product::paginate(9);
            return view('home.userpage', compact('product'));
        }
    }

    public function delivered($id){
        if(Auth::id() && (Auth::User()->usertype == 1)){
        $order=Order::find($id);
        $order->delivery_status='delivered';
        $order->payment_status='paid';
        $order->save();

        return redirect()->back()->with('message','Order Delivered Successfully');
        }else{
            $product=Product::paginate(9);
            return view('home.userpage', compact('product'));
        }
    }

    public function searchdata(Request $request){
        if(Auth::id() && (Auth::User()->usertype == 1)){
        $username=Auth::user()->name;
        $searchtext=$request->search;
        $order=Order::where('name', 'LIKE', "%$searchtext%")->
        orWhere('email', 'LIKE', "%$searchtext%")->
        orWhere('address', 'LIKE', "%$searchtext%")->
        orWhere('phone', 'LIKE', "%$searchtext%")->
        orWhere('product', 'LIKE', "%$searchtext%")->
        orWhere('quantity', 'LIKE', "%$searchtext%")->
        orWhere('price', 'LIKE', "%$searchtext%")->
        orWhere('payment_status', 'LIKE', "%$searchtext%")->
        orWhere('delivery_status', 'LIKE', "%$searchtext%")->
        orWhere('id', 'LIKE', "%$searchtext%")->
        get();
        return view('admin.order', compact('order', 'username'));
        }else{
            $product=Product::paginate(9);
            return view('home.userpage', compact('product'));
        }
    }
}
