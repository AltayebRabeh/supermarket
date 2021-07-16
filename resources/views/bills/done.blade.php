@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">{{ __('الفواتير') }}
                    <a href="javascript:void();" onclick="window.print();"
                        class="mr-auto btn btn-success btn-sm print">طباعة</a>
                </div>

                <div class="card-body">
                    <div class="teble-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>إسم العميل</td>
                                    <td>العنوان</td>
                                    <td>الهاتف</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bills as $bill)

                                    <tr>
                                        <td><a href="{{ route('bill.details', $bill->id) }}">{{ $bill->id }}</a></td>
                                        <td><a href="{{ route('bill.details', $bill->id) }}">{{ $bill->name }}</a></td>
                                        <td><a href="{{ route('bill.details', $bill->id) }}">{{ $bill->address }}</a>
                                        </td>
                                        <td><a href="{{ route('bill.details', $bill->id) }}">{{ $bill->phone }}</a></td>
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
                                        {!! $bills->links() !!}
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
