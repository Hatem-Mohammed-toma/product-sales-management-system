@extends('layout.app')

@section('title', 'إدارة الفئات')

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

        <div class="col-lg-8 m-auto" dir="rtl">
            <div class="card card-primary card-outline mt-5 shadow-lg">
                <div class="card-header text-center rounded-top">
                    <h4 class="card-title mb-0 fw-bold">قائمة الفئات</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="fw-bold mt-2">إدارة الفئات</h5>
                        <a href="{{ route('create') }}" class="btn btn-primary fw-bold">
                            + إضافة فئه جديده
                        </a>
                    </div>

                    {{-- جدول عرض المنتجات --}}
                    @if ($categories->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table text-center align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">الاسم</th>
                                        <th scope="col">الكود</th>
                                        <th scope="col">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->code }}</td>
                                            <td>
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('categories.edit', $category->id) }}">
                                                    تعديل
                                                </a>

                                                <!-- زرار يفتح المودال -->
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $category->id }}">
                                                    حذف
                                                </button>

                                                <!-- مودال الحذف -->
                                                <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1"
                                                    aria-labelledby="deleteModalLabel{{ $category->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel{{ $category->id }}">
                                                                    تأكيد الحذف
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="إغلاق"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                هل أنت متأكد أنك تريد حذف التصنيف:
                                                                <strong>{{ $category->name }}</strong> ؟
                                                            </div>
                                                            <div class="modal-footer justify-content-center">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    إلغاء
                                                                </button>
                                                                <form
                                                                    action="{{ route('categories.destroy', $category->id) }}"
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
                                                <!-- نهاية المودال -->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    @else
                        <div class="alert alert-warning text-center fw-bold">
                            لا توجد فئات حالياً
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
