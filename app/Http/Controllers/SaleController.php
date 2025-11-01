<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SaleController extends Controller
{
    public function page()
    {
        return view('sales.create');
    }
    // إدخال عملية بيع
  public function store(SaleRequest $request)
    {
           // 🔹 البحث بالكود أو الاسم
    $product = Product::where('code', $request->code)
                      ->orWhere('name', $request->code) // هنا اسم المنتج بدلاً من الكود
                      ->first();

        if (!$product) {
            return back()->with('notFound', 'المنتج غير موجود!');
        }

        if ($product->quantity < $request->quantity) {
            return back()->with('quantity', 'الكمية غير متاحة!');
        }

        $total = $product->price * $request->quantity;

        Sale::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $product->price,
            'total' => $total,
            'cost' => $product->cost * $request->quantity,
            'order_date' => now(),
        ]);

        $product->decrement('quantity', $request->quantity);

        return back()->with('success', 'تم تسجيل البيع بنجاح');
    }

    public function report()
    {
        $today = Carbon::today();
        $monthStart = Carbon::now()->startOfMonth();

        // المبيعات اليومية
        $dailySales = Sale::whereDate('order_date', $today)->with('product')->get();
        $dailyTotal = $dailySales->sum('total');
        $dailyProfit = $dailySales->sum('total') - $dailySales->sum('cost');

        // المبيعات الشهرية
        $monthlyReports = Sale::selectRaw('
    YEAR(order_date) as year,
    MONTH(order_date) as month,
    SUM(total) as total_sum,
    (SUM(total) - SUM(cost)) as profit_sum
')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('sales.report', compact(
            'dailySales',
            'dailyTotal',
            'dailyProfit',
            'monthlyReports'
        ));
    }
    public function monthlyDetails($year, $month)
    {
        // المبيعات الخاصة بالشهر المحدد
        $sales = Sale::whereYear('order_date', $year)
            ->whereMonth('order_date', $month)
            ->with('product')
            ->get();

        $total = $sales->sum('total');
        $profit = $sales->sum('total') - $sales->sum('cost');

        return view('sales.monthly-details', compact('sales', 'year', 'month', 'total', 'profit'));
    }
}
