<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Products;
use App\Models\User;
use Cashfree\Model\OrderMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cashfree\cashfree;
use Cashfree\Model\CreateOrderRequest;
use Cashfree\Model\CustomerDetails;
use Exception;

class HomeController extends Controller
{
   function adminindex()
   {
      $orders = Order::all()->count();
      $products =  Products::all()->count();
      $users = User::where('usertype', 'user')->count();
      $delivered = Order::where('status', 'delivered')->get()->count();
      return view('admin.index', compact('orders', 'products', 'users', 'delivered'));
   }

   function homeindex()
   {
      $products = Products::all();
      $count = 0;
      if (Auth::check()) {
         $userId = Auth::user()->id;
         $count = Cart::where('user_id', $userId)->count();
      }
      return view('home.index', compact('products', 'count'));
   }

   function productdetail($id)
   {
      $products = Products::find($id);
      $count = 0;
      if (Auth::check()) {
         $userId = Auth::user()->id;
         $count = Cart::where('user_id', $userId)->count();
      }
      return view('home.productdetails', compact('products', 'count'));
   }
   function payment()
   {
      return view('home.payment');
   }
   // function paymentsubmit(Request $request)
   // {
   //    $validate = $request->validate([
   //       'name' => 'required',
   //       'email' => 'required',
   //       'number' => 'required',
   //       'amount' => 'required'

   //    ]);
   //    $customerId = "UID" . Auth::user()->id;
   //    cashfree::$XClientId = "13764729ed596674a0f96e06f3746731";
   //    Cashfree::$XClientSecret = "1f4ee1fd095fcd3cfa702f0c91389c8adca03b5a";
   //    Cashfree::$XEnvironment = Cashfree::$SANDBOX;

   //    $cashfree = new Cashfree();
   //    $x_api_version = "2023-08-01";
   //    $order_id = 'inv_' . date('yndHis');
   //    $order_amount = $validate['amount'];
   //    $order_note = "thankyou for working with us";
   //    $customer_name = "customer" . $validate['name'];
   //    $customer_email = "customer" . $validate['email'];
   //    $customer_phone = $validate['number'];


   //    $return_url = 'http://127.0.0.1:8000/success' . $order_id;
   //    $create_orders_request = new CreateOrderRequest();

   //    $create_orders_request->setOrderId($order_id);
   //    $create_orders_request->setOrderAmount($order_amount);
   //    $create_orders_request->setOrderCurrency('INR');

   //    $customer_details = new CustomerDetails();
   //    $customer_details->setCustomerId($customerId);
   //    $customer_details->setCustomerName($customer_name);
   //    $customer_details->setCustomerEmail($customer_email);
   //    $customer_details->setCustomerPhone($customer_phone);


   //    $create_orders_request->setCustomerDetails($customer_details);
   //    $order_meta = new OrderMeta();

   //    $order_meta->setReturnUrl($return_url);
   //    $create_orders_request->setOrderMeta($order_meta);

   //    try {
   //       $result = $cashfree->PGCreateOrder($x_api_version, $create_orders_request);
   //       $payment_session_id = $result[0]['payment_session_id'] ?? null;
   //       return view('home.payment', compact('payment_session_id'));
   //    } catch (Exception $e) {
   //       echo "'Exception" . $e->getMessage();
   //    }





   //    // dd($request);
   // }
   // function paymentsuccess($orderId)
   // {

   //    $url = "https://sandbox.cashfree.com/pg/orders/$orderId";
   //    $ch = curl_init();
   //    curl_setopt($ch, CURLOPT_URL, $url);
   //    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
   //    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
   //    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   //    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   //    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   //    curl_setopt($ch, CURLOPT_HTTPHEADER, [
   //       'Accept: application/json',
   //       'x-api-version: 2023-08-01',
   //       'Content-Type: application/json',
   //       'x-client-id: 13764729ed596674a0f96e06f3746731',
   //       'x-client-secret: 1f4ee1fd095fcd3cfa702f0c91389c8adca03b5a'
   //    ]);

   //    $results = curl_exec($ch);
   //    if (curl_errno($ch)) {
   //       $error_msg = curl_error($ch);
   //       curl_close($ch);
   //       return back()->withErrors('cURL Error: ' . $error_msg);
   //    }

   //    $response = json_decode($results, true);
   //    curl_close($ch);

   //    return view('home.success', compact('response'));
   // }
}
