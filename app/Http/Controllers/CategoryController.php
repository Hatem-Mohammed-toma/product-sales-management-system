<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    // عرض كل الفئات
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    // نموذج إنشاء فئة جديدة
    public function create()
    {
        return view('category.create');
    }

    // تخزين الفئة الجديدة
    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route('categories')->with('success', 'تمت إضافة الفئة بنجاح');
    }


    // عرض فئة معينة (اختياري، لو عايز)
    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }

    // نموذج تعديل الفئة
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    // تحديث الفئة
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return redirect()->route('categories')->with('update', 'تم تحديث الفئة بنجاح');
    }

    // حذف الفئة
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories')->with('delete', 'تم حذف الفئة بنجاح');
    }
}