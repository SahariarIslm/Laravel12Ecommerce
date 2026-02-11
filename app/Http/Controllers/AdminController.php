<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function addCategory(){
        return view('admin.addcategory');
    }
    public function postAddCategory(Request $request){
        $category = new Category;
        $category->category = $request->category;
        $category->save();
        return redirect()->back()->with('category_message','Category Added Successfully!');
    }
    public function viewCategory(){
        $categories = Category::all();
        return view('admin.viewcategory',compact('categories'));
    }
    public function deleteCategory($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('delete_category','Category Deleted Successfully!');
    }
    public function updateCategory($id){
        $category = Category::findOrFail($id);
        return view('admin.updatecategory',compact('category'));
    }
    public function postUpdateCategory(Request $request, $id){
        $category = Category::findOrFail($id);
        $category->category = $request->category;
        $category->update();
        return redirect()->back()->with('category_updated_message','Category Updated Successfully!');
    }
    public function addProduct(){
        $categories = Category::all();
        return view('admin.addproduct',compact('categories'));
    }
    public function postAddProduct(Request $request){
        $product = new Product;
        $product->product_title = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_category = $request->product_category;
        $product->product_price = $request->product_price;
        $product->product_quantity = $request->product_quantity;
        $image = $request->file('product_image');
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('products'), $imagename);
            $product->product_image = $imagename;
        }
        $product->save();
        return redirect()->back()->with('product_message', 'Product Added Successfully!');
    }
    public function viewProduct(){
        $products = Product::paginate(5);
        return view('admin.viewproduct',compact('products'));
    }
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        if (!empty($product->product_image)) {
            $image_path = public_path('products/' . $product->product_image);

            if (file_exists($image_path) && is_file($image_path)) {
                unlink($image_path);
            }
        }

        $product->delete();

        return redirect()->back()->with('delete_product', 'Product Deleted Successfully!');
    }
    public function updateProduct($id){
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.updateproduct',compact('product','categories'));
    }
    public function postUpdateProduct(Request $request, $id){
        $product = Product::findOrFail($id);
        $product->product_title = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_category = $request->product_category;
        $product->product_price = $request->product_price;
        $product->product_quantity = $request->product_quantity;
        $image = $request->file('product_image');
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('products'), $imagename);
            $product->product_image = $imagename;
        }
        $product->save();
        return redirect()->back()->with('product_message', 'Product Updated Successfully!');
    }
    public function searchProduct(Request $request){
        $products = Product::where('product_title','LIKE','%'.$request->search.'%')
        ->orWhere('product_description','LIKE','%'.$request->search.'%')
        ->orWhere('product_category','LIKE','%'.$request->search.'%')->paginate(2);
        return view('admin.viewproduct',compact('products'));
    }
    public function viewOrder(){
        $orders = Order::all();
        return view('admin.vieworder',compact('orders'));
    }
    public function changeStatus(Request $request, $id){
        $order = order::findOrFail($id);
        $order->status = $request->status;
        $order->update();
        return redirect()->back()->with('change_status','Status Updated Successfully!');
    }
    public function downloadPdf($id){
        $data = order::findOrFail($id);
        $pdf = Pdf::loadView('admin.invoice', compact('data'));
        return $pdf->download('invoice.pdf');
    }
}