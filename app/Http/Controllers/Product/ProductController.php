<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Log;

class ProductController extends Controller
{
    public function viewAddCatogery()
    {
        return view('staff-panel.category.add-category');
    }

    public function viewAddProduct()
    {
        $categeries = Category::all();

        return view('staff-panel.product.add-product', [
            'categeries' => $categeries,
        ]);
    }

    public function storeCatogery(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'order' => 'required',
        ]);

        Category::create([
            'category_name' => $request->category_name,
            'order' => $request->order,
        ]);

        return redirect()->route('lsiting.category')->with('success', 'Category created successfully');
    }

    public function viewCategoryList()
    {
        $data = Category::all();

        return view('staff-panel.category.category-listing', [
            'data' => $data,
            'i' => 1,
        ]);
    }

    public function getCategoryDetails(Category $category)
    {
        try {

            return response()->json([
                'status' => true,
                'categoryDetails' => $category,
            ]);
        } catch (\Exception $ex) {
            Log::error('getClientService', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);

            return response()->json([
                'message' => $ex->getMessage(),
            ], 404);
        }
    }

    public function getProductDetails(Product $product)
    {
        try {

            // dd($product->product_images);
            return response()->json([
                'status' => true,
                'productDetails' => $product,
            ]);
        } catch (\Exception $ex) {
            Log::error('getClientService', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);

            return response()->json([
                'message' => $ex->getMessage(),
            ], 404);
        }
    }

    public function storeCategoryUpdate(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'order' => 'required',
            'category_id' => 'required',
        ]);

        $categoryModelInstance = Category::find($request->category_id);
        $categoryModelInstance->update([
            'category_name' => $request->category_name,
            'order' => $request->order,
        ]);

        return redirect()->route('lsiting.category')->with('success_update', 'Category update successfully');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'product_image' => 'required',
            'product_name' => 'required',
            'category_id' => 'required',
            'quantity' => 'required',
            'description' => 'required',
        ]);

        // $productModelInstance = new Product();
        $productModelInstance = Product::create([
            // 'product_image' => $filename,
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        if ($request->hasFile('product_image')) {
            $filenames = [];

            foreach ($request->file('product_image') as $file) {
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $path = $file->storeAs('public/product-img/', $filename);

                $filenames[] = $filename;
            }

            // Set the product_images attribute as an array
            $productModelInstance->product_images = $filenames;
            $productModelInstance->save();
            // Save the model

        }


        return redirect()->route('lsiting.product')->with('success', 'Category created successfully');
    }

    public function storeProductDetails(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'product_name' => 'required',
            'category_id' => 'required',
            'quantity' => 'required',
            'description' => 'required',
        ]);

        $productModelInstanse = Product::find($request->product_id);

        if ($request->file('product_image')) {
            $file = $request->file('product_image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $path = $file->storeAs('public/product-img/', $filename);
            $productModelInstanse->product_image = $filename;
        }

        $productModelInstanse->update([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect()->route('lsiting.product')->with('update_success', 'Category update successfully');
    }

    public function viewProdcutList()
    {
        $data = Product::all();
        $categeries = Category::all();

        // dd($data[7]->product_images);

        // $secondImageName = json_decode($data[7]->product_image,true);
        // $decodedArray = json_decode($data[7]->product_images, true);
        // dd($decodedArray);

        return view('staff-panel.product.product-listing', [
            'data' => $data,
            'categeries' => $categeries,
            'i' => 1,
        ]);
    }
}
