@extends('layout.app')

@section('title', 'اضافة فئه جديده')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-6 m-auto" dir="rtl">
            <div class="card card-primary card-outline mt-5 shadow-lg">
                <div class="card-header text-center rounded-top">
                    <h4 class="card-title mb-0 fw-bold">إضافة فئة جديدة</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">اسم الفئة</label>
                            <input type="text" title="اسم الفئة" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="code" class="form-label fw-bold">كود الفئة</label>
                            <input type="text" title="كود الفئة" class="form-control @error('code') is-invalid @enderror"
                                id="code" name="code" value="{{ old('code') }}">
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary fw-bold">إضافة الفئة</button>
                        <a href="{{ route('categories') }}" class="btn btn-secondary fw-bold">إلغاء</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
