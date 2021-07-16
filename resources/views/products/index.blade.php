@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header d-flex">{{ __('المنتجات') }}
                    <a href="javascript:void();" onclick="window.print();"
                        class="mr-auto btn btn-success btn-sm print">طباعة</a>
                    <a class="btn btn-primary btn-sm mr-auto" href="{{ route('products.create') }}">منتج جديد</a>
                </div>

                <div class="card-body">
                    <div class="teble-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>صورة المنتج</td>
                                    <td>اسم المنتج</td>
                                    <td>الصنف</td>
                                    <td>الكمية</td>
                                    <td>السعر</td>
                                    <td>التاريخ</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td><img src="{{ asset($product->image) }}" width="60"></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->qty }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->created_at }}</td>
                                        <td>
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="btn btn-warning btn-sm">تعديل</a>
                                            <a href="javascript:void()"
                                                onclick="if(confirm('هل تريد الحذف')){document.getElementById('product-{{ $product->id }}').submit();};"
                                                class="btn btn-danger btn-sm">حذف</a>
                                            <form action="{{ route('products.destroy', $product->id) }}"
                                                id="product-{{ $product->id }}" method="POST">@csrf</form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">لايوجد نتائج</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        {!! $products->links() !!}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
