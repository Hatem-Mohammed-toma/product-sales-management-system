@extends('layout.app')

@section('title', 'تقرير المبيعات')

@section('content')
    <div class="container-fluid" dir="rtl">
        {{-- ✅ تقرير اليوم --}}
        <div class="card shadow mt-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">📅 تقرير اليوم</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>اسم المنتج</th>
                                <th>الكمية</th>
                                <th>سعر الوحدة</th>
                                <th>الإجمالي</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dailySales as $sale)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sale->product->name }}</td>
                                    <td>{{ $sale->quantity }}</td>
                                    <td>{{ number_format($sale->price, 2) }}</td>
                                    <td class="fw-bold text-success">{{ number_format($sale->total, 2) }}</td>
                                    <td>{{ $sale->order_date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-muted">لا توجد مبيعات اليوم</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ✅ تقرير الشهر --}}
        <div class="card shadow mt-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">📊 تقرير المبيعات الشهرية</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>الإجمالي</th>
                                <th>الربح</th>
                                <th>الشهر</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($monthlyReports as $index => $report)
                                <tr>
                                    <td>{{ $index + 1 }}</td>

                                    <td class="fw-bold text-success">{{ number_format($report->total_sum, 2) }}</td>
                                    <td class="fw-bold text-primary">{{ number_format($report->profit_sum, 2) }}</td>
                                    <td>
                                        <a
                                            href="{{ route('sales.monthly.details', ['year' => $report->year, 'month' => $report->month]) }}">
                                            {{ $report->year }}-{{ str_pad($report->month, 2, '0', STR_PAD_LEFT) }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-muted">لا توجد مبيعات مسجلة</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
