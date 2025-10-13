@extends('layout.app')

@section('title', 'بحث')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-5 m-auto">
                <div class="card card-primary card-outline shadow-lg mt-5">
                    <div class="card-header">
                        <h3 class="card-title">بحث عن منتجات محددة</h3>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('search.perform') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="input" class="form-label">🔍 أدخل كود المنتج أو اسمه:</label>
                                <input type="text" class="form-control" id="input" name="input"
                                    title="مثال: P1 أو سماعات" required>
                            </div>
                            <button type="submit" class="btn btn-primary">بحث</button>
                        </form>
                    </div>

                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->
    </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
@endsection
