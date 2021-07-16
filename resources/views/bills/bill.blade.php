@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card d-flex">
                <div class="card-header d-flex">{{ __('الفاتورة') }}
                    <a href="javascript:void();" onclick="window.print();"
                        class="btn btn-success mr-auto btn-sm print">طباعة</a>
                </div>

                <div class="card-body">
                    <div class="teble-responsive">
                        <table class="table">
                            <tr>
                                <th>رقم الفاتورة</th>
                                <td>{{ $bill->id }}</td>
                                <th>إسم العميل</th>
                                <td>{{ $bill->name }}</td>
                            </tr>
                            <tr>
                                <th>العنوان</th>
                                <td>{{ $bill->address }}</td>
                                <th>رقم الهاتف</th>
                                <td>{{ $bill->phone }}</td>
                            </tr>
                            <tr>
                                <th>التاريخ</th>
                                <td>{{ $bill->created_at }}</td>
                                <th>الحالة</th>
                                <td>{{ $bill->status() }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header d-flex">{{ __('التفاصيل') }}
                </div>

                <div class="card-body">
                    <div class="teble-responsive">
                        <table class="table text-right">
                            <thead>
                                <tr>
                                    <th>إسم المنتج</th>
                                    <th>الكمية</th>
                                    <th>السعر</td>
                                    <th>الاجمالي</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @if ($bill->sales)
                                    @foreach ($bill->sales as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->price * $item->qty }}</td>
                                            @php $total += $item->price * $item->qty @endphp
                                        </tr>
                                    @endforeach
                                @else

                                @endif
                            </tbody>
                            <tfoot>
                                @if ($bill->sales)
                                    <tr>
                                        <th colspan="3"></th>
                                        <th>{{ $total }}</th>
                                    </tr>
                                @endif
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
