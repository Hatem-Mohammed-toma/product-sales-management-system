@extends('layout.app')
@section('title', ' تفاصيل المبيعات اليومية ')
@section('content')
    <div class="container-fluid" dir="rtl">
    <div class="card shadow mt-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">🗓️ تفاصيل مبيعات يوم {{ $date }}</h5>
        </div>
        <div class="card-body">
            <p><strong>إجمالي المبيعات:</strong> {{ number_format($total, 2) }} ج.م</p>
            <p><strong>إجمالي الأرباح:</strong> {{ number_format($profit, 2) }} ج.م</p>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>اسم المنتج</th>
                            <th>الكمية</th>
                            <th>سعر الوحدة</th>
                            <th>الإجمالي</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sale->product->name }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>{{ number_format($sale->price, 2) }} ج.م</td>
                                <td>{{ number_format($sale->total, 2) }} ج.م</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted">لا توجد مبيعات في هذا اليوم</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
