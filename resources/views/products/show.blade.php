@extends('layout.app')

@section('title', 'تفاصيل المنتج')

@section('content')
    <div class="col-lg-6 m-auto" dir="rtl">
        <div class="card card-primary card-outline mt-5 shadow-lg">
            <div class="card-header text-center rounded-top">
                <h4 class="card-title mb-0 fw-bold">تفاصيل المنتج</h4>
            </div>

            <div class="card-body">
                <h5 class="fw-bold mb-3">معلومات المنتج</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>الاسم:</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>الكود:</th>
                        <td>{{ $product->code }}</td>
                    </tr>
                    <tr>
                        <th>السعر:</th>
                        <td>{{ $product->price }} ج.م</td>
                    </tr>
                    <tr>
                        <th>الكمية:</th>
                        <td>{{ $product->quantity }}</td>
                    </tr>
                    <tr>
                        <th>التكلفة:</th>
                        <td>{{ $product->cost }} ج.م</td>
                    </tr>
                    <tr>
                        <th>الفئة:</th>
                        <td>{{ $product->category->name }}</td>
                    </tr>
                </table>

                <a href="{{ route('products') }}" class="btn btn-secondary fw-bold mt-3">العودة إلى قائمة المنتجات</a>
            </div>
        </div>
    </div>
@endsection