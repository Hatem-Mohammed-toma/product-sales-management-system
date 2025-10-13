<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.index');
    }
    public function search(Request $request)
    {
        $input = $request->input;

        $product = Product::where('code', 'LIKE',  "%{$input}%")
            ->orWhere('name', 'LIKE', "%{$input}%")->get();
        return view('search.result', compact('product', 'input'));
    }
}