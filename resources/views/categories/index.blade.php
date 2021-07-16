@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">{{ __('الاصناف') }}
                    <a href="javascript:void();" onclick="window.print();"
                        class="mr-auto btn btn-success btn-sm print">طباعة</a>
                    <a class="btn btn-primary btn-sm mr-auto" href="{{ route('categories.create') }}">صنف جديد</a>
                </div>

                <div class="card-body">
                    <div class="teble-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>اسم الصنف</td>
                                    <td>وصف الصنف</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>
                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="btn btn-warning btn-sm">تعديل</a>
                                            <a href="javascript:void()"
                                                onclick="if(confirm('هل تريد الحذف')){document.getElementById('category-{{ $category->id }}').submit();};"
                                                class="btn btn-danger btn-sm">حذف</a>
                                            <form action="{{ route('categories.destroy', $category->id) }}"
                                                id="category-{{ $category->id }}" method="POST">@csrf</form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">لايوجد نتائج</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">
                                        {!! $categories->links() !!}
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
