@extends('layout.app')

@section('title', 'الرئيسية')

@section('content')
    <div class="container-fluid" dir="rtl">

        {{-- ✅ كروت الملخص --}}
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3 mt-4">
                <div class="info-box">
                    <span class="info-box-icon text-bg-primary shadow-sm">
                        <i class="bi bi-cash-coin"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">مبيعات اليوم</span>
                        <span class="info-box-number">{{ number_format($dailyTotal, 2) }} ج.م</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3 mt-4">
                <div class="info-box">
                    <span class="info-box-icon text-bg-success shadow-sm">
                        <i class="bi bi-graph-up-arrow"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">أرباح اليوم</span>
                        <span class="info-box-number">{{ number_format($dailyProfit, 2) }} ج.م</span>
                    </div>
                </div>
            </div>

            @php
                $report = $monthlyReports->first();
            @endphp

            @if ($report)
                <div class="col-12 col-sm-6 col-md-3 mt-4">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-info shadow-sm">
                            <i class="bi bi-calendar3"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">مبيعات الشهر</span>
                            <span class="info-box-number">{{ number_format($report->total_sum, 2) }} ج.م</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3 mt-4">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-warning shadow-sm">
                            <i class="bi bi-piggy-bank-fill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">أرباح الشهر</span>
                            <span class="info-box-number">{{ number_format($report->profit_sum, 2) }} ج.م</span>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-muted">لا توجد بيانات لهذا الشهر</p>
            @endif

        </div>

        {{-- ✅ الرسم البياني --}}
        <div class="card shadow mt-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">📈 الرسم البياني لمبيعات الشهر</h5>
            </div>
            <div class="card-body">
                <canvas id="salesChart" height="100"></canvas>
            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($chartLabels ?? []);
        const salesData = @json($chartSales ?? []);
        const profitData = @json($chartProfit ?? []);

        const labelsAr = labels.map(d => {
            try {
                const dt = new Date(d + 'T00:00:00');
                return dt.toLocaleDateString('ar-EG', {
                    day: 'numeric',
                    month: 'short'
                });
            } catch (e) {
                return d;
            }
        });

        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labelsAr,
                datasets: [{
                        label: 'إجمالي المبيعات',
                        data: salesData,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true,
                        tension: 0.3
                    },
                    {
                        label: 'صافي الأرباح',
                        data: profitData,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(val) {
                                return val + ' ج.م';
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
