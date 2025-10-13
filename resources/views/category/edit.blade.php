@extends('layout.app')

@section('title', 'تعديل الفئه')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-6 m-auto" dir="rtl">
            <div class="card card-primary card-outline mt-5 shadow-lg">
                <div class="card-header text-center rounded-top">
                    <h4 class="card-title mb-0 fw-bold">تعديل الفئة</h4>
                </div>
                <div class="card-body"> <!--begin::Card Body-->
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">اسم الفئة</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $category->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label fw-bold">كود الفئة</label>
                            <input type="text" class="form-control" id="code" name="code"
                                value="{{ old('code', $category->code) }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary fw-bold">تحديث الفئة</button>
                        <a href="{{ route('categories') }}" class="btn btn-secondary fw-bold">إلغاء</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection