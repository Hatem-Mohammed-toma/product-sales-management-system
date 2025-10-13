@extends('layout.app')

@section('title', 'اضافة المنتاجات')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-6 m-auto" dir="rtl">
            <div class="card card-primary card-outline mt-4 shadow-lg">

                <div class="card-header text-center rounded-top">
                    <h4 class="card-title mb-0 fw-bold">إضافة منتج جديد</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">اسم المنتج</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="code" class="form-label fw-bold">كود المنتج</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                                name="code" value="{{ old('code') }}">
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label fw-bold">السعر</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                name="price" value="{{ old('price') }}">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label fw-bold">الكمية</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                id="quantity" name="quantity" value="{{ old('quantity') }}" min="1">
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cost" class="form-label fw-bold">تكلفة المنتج</label>
                            <input type="number" class="form-control @error('cost') is-invalid @enderror" id="cost"
                                name="cost" value="{{ old('cost') }}">
                            @error('cost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label fw-bold">الفئة</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                                name="category_id">
                                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>اختر فئة
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary fw-bold">إضافة المنتج</button>
                        <a href="{{ route('products') }}" class="btn btn-secondary fw-bold">إلغاء</a>
                </div>

                </form>
            </div>
        </div>
    </div>
    </div>

@endsection
