@extends('layout.app')

@section('title', 'تعديل المنتج')

@section('content')
    <div class="container-fluid">
        @include('error')
        <div class="col-lg-6 m-auto" dir="rtl">
            <div class="card card-primary card-outline mt-4 shadow-lg">

                <div class="card-header text-center rounded-top">
                    <h4 class="card-title mb-0 fw-bold">تعديل المنتج</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">اسم المنتج</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $product->name) }}">
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label fw-bold">كود المنتج</label>
                            <input type="text" class="form-control" id="code" name="code"
                                value="{{ old('code', $product->code) }}">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label fw-bold">السعر</label>
                            <input type="number" class="form-control" id="price" name="price"
                                value="{{ old('price', $product->price) }}">
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label fw-bold">الكمية</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                value="{{ old('quantity', $product->quantity) }}">
                        </div>
                        <div class="mb-3">
                            <label for="cost" class="fw-bold">تكلفة المنتج</label>
                            <input type="number" class="form-control" id="cost" name="cost"
                                value="{{ old('cost', $product->cost) }}">
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label fw-bold">الفئة</label>
                            <select class="form-select" id="category_id" name="category_id">
                                <option value="" disabled>اختر فئة</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary fw-bold">تحديث المنتج</button>
                        <a href="{{ route('products') }}" class="btn btn-secondary fw-bold">إلغاء</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
