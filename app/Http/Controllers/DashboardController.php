<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function chart()
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
            ->whereYear('order_date', now()->year)   // السنة الحالية
            ->whereMonth('order_date', now()->month) // الشهر الحالي
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $chartLabels = Sale::whereMonth('order_date', now()->month)
            ->selectRaw('DATE(created_at) as date')
            ->groupBy('date')
            ->pluck('date');

        $chartSales = Sale::whereMonth('order_date', now()->month)
            ->selectRaw('SUM(total) as total')
            ->groupByRaw('DATE(created_at)')
            ->pluck('total');

        $chartProfit = Sale::whereMonth('order_date', now()->month)
            ->selectRaw('SUM(total - cost) as profit')
            ->groupByRaw('DATE(created_at)')
            ->pluck('profit');

        return view('dashboard', compact(
            // 'monthlySales',

            'dailySales',
            'dailyTotal',
            'dailyProfit',
            // 'monthlyTotal',
            // 'monthlyProfit',
            'monthlyReports',
            'chartLabels',
            'chartSales',
            'chartProfit'
        ));
    }
}