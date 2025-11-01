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
    <div class="mb-3 position-relative">
        <label for="code" class="form-label fw-bold">كود المنتج أو الاسم</label>
        <input type="text" name="code" id="code"
               class="form-control @error('code') is-invalid @enderror"
               placeholder="أدخل كود أو اسم المنتج" autocomplete="off"
               value="{{ old('code') }}">

        {{-- القائمة اللي هتظهر فيها النتائج --}}
        <ul id="product-list" class="list-group position-absolute w-100 mt-1"
            style="z-index:1000; display:none; cursor:pointer;"></ul>

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
</form>

{{-- ✅ جافاسكريبت للبحث --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#code').on('keyup', function() {
        let query = $(this).val();

        if (query.length > 1) {
            $.ajax({
                url: "{{ route('products.search') }}",
                type: "GET",
                data: { q: query },
                success: function(data) {
                    let list = $('#product-list');
                    list.empty();

                    if (data.length > 0) {
                        list.show();
                        data.forEach(function(item) {
                            list.append(`
                                <li class="list-group-item list-group-item-action"
                                    data-code="${item.code}">
                                    ${item.name} (${item.code}) - ${item.price} جنيه
                                </li>
                            `);
                        });
                    } else {
                        list.hide();
                    }
                }
            });
        } else {
            $('#product-list').hide();
        }
    });

    // لما المستخدم يختار منتج من القائمة
    $(document).on('click', '#product-list li', function() {
        let code = $(this).data('code');
        $('#code').val(code);
        $('#product-list').hide();
    });
});
</script>


                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
@endsection
