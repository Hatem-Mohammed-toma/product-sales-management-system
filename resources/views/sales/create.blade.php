@extends('layout.app')

@section('title', 'مبيعات جديدة')
<style>
    .success,
    .delete {
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
</style>

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div x-data="{ open: true }" x-init="setTimeout(() => open = false, 3000)" class="success" x-bind:class="{ 'show': open, 'hide': !open }"
                role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('notFound'))
            <div x-data="{ open: true }" x-init="setTimeout(() => open = false, 3000)" class="delete" x-bind:class="{ 'show': open, 'hide': !open }"
                role="alert">
                {{ session('notFound') }}
            </div>
        @endif
        @if (session('quantity'))
            <div x-data="{ open: true }" x-init="setTimeout(() => open = false, 3000)" class="delete"
                x-bind:class="{ 'show': open, 'hide': !open }" role="alert"> {{ session('quantity') }}
            </div>
        @endif
        <div class="row">
            <div class="col-6 m-auto">
                <div class="card card-primary card-outline mt-5 shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title">إنشاء مبيعات جديدة</h3>
                    </div> <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <form action="{{ route('sales.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="code" class="form-label fw-bold">كود المنتج</label>
                                <input type="text" name="code" id="code"
                                    class="form-control @error('code') is-invalid @enderror" title="أدخل كود المنتج"
                                    value="{{ old('code') }}">
                                @error('code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label fw-bold">الكمية</label>
                                <input type="number" name="quantity" id="quantity"
                                    class="form-control @error('quantity') is-invalid @enderror"
                                    value="{{ old('quantity') }}">
                                @error('quantity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">بيع</button>
                        </form> <!--end form-->
                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
@endsection
