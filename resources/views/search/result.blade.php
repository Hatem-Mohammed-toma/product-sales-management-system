@extends('layout.app')

@section('title', 'نتائج البحث')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 m-auto">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="card-subtitle">
                            نتائج البحث عن المنتج : <strong>{{ $input }}</strong>
                        </h3>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-striped text-center align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">كود المنتج</th>
                                    <th scope="col">اسم المنتج</th>
                                    <th scope="col">السعر</th>
                                    <th scope="col">الكمية</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($product as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price }} ج.م</td>
                                        <td>{{ $item->quantity }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-danger fw-bold">
                                            لا توجد نتائج مطابقة.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
@endsection
