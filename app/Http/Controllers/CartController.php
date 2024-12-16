<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    function carts()
    {
        $cartCount = 0;
        $userId = null;
        $cart = collect();
        if (Auth::check()) {
            $userId = Auth::user()->id;

            $cart = Cart::where('user_id', $userId)->get();
            $cartCount = $cart->sum('quantity');
        }
        return view('home.carts', compact('userId', 'cartCount', 'cart'));
    }

    function addtocart($id, Request $request)
    {

        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;
        $quantity = $request->input('quantity', 1);
        $cartItem = Cart::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;

            $cartItem->save();
        } else {
            $data = new Cart();
            $data->user_id = $user_id;
            $data->product_id = $product_id;
            $data->quantity = $quantity;
            $data->save();
        }
        toastr()->closeButton()->addSuccess('Added to cart');

        return redirect('/');
    }
    function deletecart($id)
    {
        $item = Cart::find($id);
        $item->delete();
        return redirect()->back()->with('success', 'Item deleted succesfully');
    }
    function billingpage()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $carts = Cart::where('user_id', $user_id)->get();
        return view('home.billingpage', compact('carts', 'user'));
    }
    function order()
    {
        $user = Auth::user()->id;
        $orders = Order::where('user_id', $user)->get();

        return view('home.order', compact('orders'));
    }
    function confirmorder(Request $request)
    {
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;

        $userId = Auth::user()->id;
        $cart = Cart::where('user_id', $userId)->get();
        $totalValue = 0;
        foreach ($cart as $carts) {
            $product = $carts->product;
            if ($product->quantity < $carts->quantity) {
                toastr()->closeButton()->addError("Insufficient Stock for {$product->title}. It has only {$product->quantity} quantity left.");
                return redirect()->back();
            }
            $totalValue += $carts->product->price * $carts->quantity;
        }
        $totalValue += 150;
        foreach ($cart as $carts) {
            $product = $carts->product;
            $product->quantity -= $carts->quantity;
            $product->save();
            $order = new Order();
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->quantity = $carts->quantity;
            $order->user_id = $userId;
            $order->product_id = $carts->product_id;
            $order->total_value = $totalValue;
            $order->save();
        }
        $cart_remove = Cart::where('user_id', $userId)->get();
        foreach ($cart_remove as $remove) {
            $data = Cart::find($remove->id);
            $data->delete();
        }
        // Cart::where('user_id', $userId)->delete();   
        toastr()->closeButton()->addSuccess('Order placed Succesfully');
        return redirect()->back();
    }
    function buynowsubmit(Request $request)
    {

        $productID = $request->input('product_id');
        $order = new Order();
        $order->product_id = $productID;
        $order->user_id = Auth::id();
        $order->quantity = 1;
        $order->status = 'pending';
        $order->save();
        return redirect()->route('checkout', ['product_id' => $productID]);
    }
    public function showCheckout($product_id)
    {
        $product = Products::findOrFail($product_id);
        $deliveryCharge = 150;
        $value = $product->price;
        $totalValue = $value + $deliveryCharge;
        
        return view('home.checkout', compact('product', 'deliveryCharge', 'value', 'totalValue'));
    }
}
