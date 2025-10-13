<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(20);
        return view('products.index', compact('products'));
    }

    // نموذج إضافة منتج
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // حفظ منتج جديد
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        Product::create($data);

        return redirect()->route('products')->with('success', 'تم إضافة المنتج بنجاح ');
    }

    // عرض منتج محدد
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // نموذج تعديل منتج
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // تحديث منتج
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        
        $product->update($data);

        return redirect()->route('products')->with('update', 'تم تحديث المنتج بنجاح');
    }

    // حذف منتج
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products')->with('delete', 'تم حذف المنتج بنجاح');
    }
}