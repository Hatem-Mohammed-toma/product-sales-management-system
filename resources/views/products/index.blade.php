@extends('layout.app')

@section('title', 'إدارة المنتجات')
<style>
    .success,
    .delete,
    .update {
        position: fixed;
        top: 8px;
        right: 15px;
        z-index: 9999;

        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        transform: translateX(120%);
        /* يبدأ خارج الشاشة */
        transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
        opacity: 0;
    }

    .success {
        background-color: #3bb001;
        color: #fff;
    }

    .delete {
        background-color: #dc3545;
        color: #fff;
    }

    .update {
        background-color: #3db4ec;
        color: white;
    }

    .success.show {
        transform: translateX(0);
        /* يدخل مكانه الطبيعي */
        opacity: 1;
    }

    .success.hide {
        transform: translateX(120%);
        /* يرجع يمين */
        opacity: 0;
    }

    .delete.show {
        transform: translateX(0);
        /* يدخل مكانه الطبيعي */
        opacity: 1;
    }

    .delete.hide {
        transform: translateX(120%);
        /* يرجع يمين */
        opacity: 0;
    }

    .update.show {
        transform: translateX(0);
        /* يدخل مكانه الطبيعي */
        opacity: 1;
    }

    .update.hide {
        transform: translateX(120%);
        /* يرجع يمين */
        opacity: 0;
    }
</style>

@section('content')

    <div class="container-fluid">
        @if (session('success'))
            <div x-data="{ open: true }" x-init="setTimeout(() => open = false, 3000)" class="success" x-bind:class="{ 'show': open, 'hide': !open }"
                role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('delete'))
            <div x-data="{ open: true }" x-init="setTimeout(() => open = false, 3000)" class="delete" x-bind:class="{ 'show': open, 'hide': !open }"
                role="alert">
                {{ session('delete') }}
            </div>
        @endif

        @if (session('update'))
            <div x-data="{ open: true }" x-init="setTimeout(() => open = false, 3000)" class="update"
                x-bind:class="{ 'show': open, 'hide': !open }" role="alert">
                {{ session('update') }}
            </div>
        @endif

        <div class="col-lg-10 m-auto" dir="rtl">
            <div class="card card-primary card-outline mt-5 shadow-lg">
                <div class="card-header text-center rounded-top">
                    <h4 class="card-title mb-0 fw-bold">قائمة المنتجات</h4>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="fw-bold mt-2">إدارة المنتجات</h5>
                        <a href="{{ route('product.create') }}" class="btn btn-primary fw-bold">
                            + إضافة منتج جديد
                        </a>
                    </div>

                    {{-- جدول عرض المنتجات --}}
                    @if ($products->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">الاسم</th>
                                        <th scope="col">الكود</th>
                                        <th scope="col">السعر</th>
                                        <th scope="col">الكمية</th>
                                        <th scope="col">التكلفة</th>
                                        <th scope="col">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <th scope="row">{{ $product->id }}</th>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->code }}</td>
                                            <td>{{ $product->price }} ج.م</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ $product->cost }} ج.م</td>
                                            <td>
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('products.show', $product->id) }}">
                                                    عرض
                                                </a>
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('products.edit', $product->id) }}">
                                                    تعديل
                                                </a>
                                                <!-- زرار يفتح المودال -->
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $product->id }}">
                                                    حذف
                                                </button>

                                                <!-- مودال الحذف -->
                                                <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1"
                                                    aria-labelledby="deleteModalLabel{{ $product->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel{{ $product->id }}">
                                                                    تأكيد الحذف
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="إغلاق"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                هل أنت متأكد أنك تريد حذف المنتج:
                                                                <strong>{{ $product->name }}</strong> ؟
                                                            </div>
                                                            <div class="modal-footer justify-content-center">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    إلغاء
                                                                </button>
                                                                <form
                                                                    action="{{ route('products.destroy', $product->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">
                                                                        تأكيد الحذف
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-warning text-center fw-bold">
                            لا توجد منتجات حالياً
                        </div>
                    @endif
                    {{ $products->links() }}
                </div>

            </div>
        </div>

    </div>


@endsection
