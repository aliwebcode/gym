<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(ProductRequest $request)
    {
        if ($image = $request->file('image')) {
            $file_name = $request->name_en . time() . "." . $image->getClientOriginalExtension();
            $path = public_path('uploads/products');
            $image->move($path, $file_name);
            $request->image = 'uploads/products/' . $file_name;

            // Save Data
            Product::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'status' => $request->status,
                'image' => $request->image,
                'cost' => $request->cost,
                'price' => $request->price,
            ]);
        }
        return redirect()->route('admin.products.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        if ($image = $request->file('image')) {
            // Delete old image
            if(File::exists($product->image))
                unlink($product->image);
            $file_name = $request->name_en . time() . "." . $image->getClientOriginalExtension();
            $path = public_path('uploads/products');
            $image->move($path, $file_name);
            $request->image = 'uploads/products/' . $file_name;
            $product->update([
                'image' => $request->image
            ]);
        }

        // Update record
        $product->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.products.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Product $product)
    {
        // Delete old image
        if(File::exists($product->image))
            unlink($product->image);
        // Delete record
        $product->delete();
        return redirect()->back()->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
