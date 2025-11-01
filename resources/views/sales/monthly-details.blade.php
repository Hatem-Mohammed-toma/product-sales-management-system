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
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>إجمالي المبيعات</th>
                                <th>إجمالي الأرباح</th>
                                <th>اليوم</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dailyReports as $index => $day)
                                <tr>
                                    <td>{{ $index + 1 }}</td>

                                    <td class="fw-bold text-success">{{ number_format($day->total_sum, 2) }} ج.م</td>
                                    <td class="fw-bold text-primary">{{ number_format($day->profit_sum, 2) }} ج.م</td>
                                    <td>
                                        <a href="{{ route('sales.daily.details', ['date' => $day->day]) }}">
                                            {{ $day->day }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-muted">لا توجد مبيعات في هذا الشهر</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
