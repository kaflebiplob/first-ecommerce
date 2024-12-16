<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    function addcategory()
    {
        $categories = Category::paginate(4);
        return view('admin.category', compact('categories'));
    }
    function categoriessubmit(Request $request)
    {
        $category = new Category();
        $category->category_name = $request->category;
        toastr()->closeButton()->addSuccess('Category added succesfully');
        $category->save();
        return redirect('/categories');
    }
    function deletecategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        toastr()->closeButton()->addSuccess('Category deleted succesfully');
        return redirect('/categories');
    }
    function editcategory($id)
    {
        $datas = Category::find($id);
        return view('admin.editcategory', compact('datas'));
    }

    function editcategorysubmit(Request $request, $id)
    {
        $data = Category::find($id);
        $data->category_name = $request->category;
        $data->save();
        toastr()->closeButton()->addSuccess('Category updated succesfully');
        return redirect('/categories');
    }

    function addproduct()
    {
        $categories = Category::all();
        return view('admin.addproduct', compact('categories'));
    }

    function addproductsubmit(Request $request)
    {
        $product = new Products();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;
        $image = $request->image;

        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products', $imagename);
            $product->image = $imagename;
        }
        toastr()->closeButton()->addSuccess('Product Added succesfully');

        $product->save();
        return redirect('/viewproduct');
    }
    function viewproduct()
    {
        $products = Products::paginate(3);
        return view('admin.viewproduct', compact('products'));
    }
    function deleteproduct($id)
    {
        $products = Products::find($id);
        $image_path = public_path('products/' . $products->image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $products->delete();
        toastr()->closeButton()->addSuccess('Product Deleted succesfully');
        return redirect()->back();
    }
    function editproduct($id)
    {
        $products = Products::find($id);
        $categories = Category::all();
        return view('admin.editproduct', compact('products', 'categories'));
    }
    function editproductsubmit(Request $request, $id)
    {
        $products = Products::find($id);
        $products->title = $request->title;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->quantity = $request->quantity;
        $products->category = $request->category;
        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products', $imagename);
            $products->image = $imagename;
        }
        $products->save();
        return redirect('/viewproduct');
    }
    function adminorder()
    {
        $orders = Order::all();
        return view('admin.order', compact('orders'));
    }
    function ontheway($id)
    {
        $orders = Order::find($id);
        $orders->status = 'on the way';
        $orders->save();
        return redirect('/order_list');
    }
    function delivered($id) {
        $orders=Order::find($id);
        $orders->status = 'delivered';
        $orders->save();
        return redirect('/order_list');
    }
}
