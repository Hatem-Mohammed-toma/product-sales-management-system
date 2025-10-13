@extends('layout.app')

@section('title', ' تفاصيل المبيعات ')

@section('content')
    <div class="container-fluid" dir="rtl">
        <div class="card shadow mt-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">📅 تفاصيل مبيعات شهر {{ $year }}-{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</h5>
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
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sales as $sale)
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
                                    <td colspan="6" class="text-muted">لا توجد مبيعات في هذا الشهر</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
