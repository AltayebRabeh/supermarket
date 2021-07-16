@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="table-responsive">
            <table class="table text-right">
                <thead>
                    <tr>
                        <th style="width: 50px"></th>
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
                    @if ($items)
                        @foreach ($items as $key => $item)
                            <tr>
                                <td>
                                    <a href="{{ route('cart-delete', $key) }}" class="btn btn-danger btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                        </svg>
                                    </a>
                                </td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['qty'] }}</td>
                                <td>{{ $item['price'] }}</td>
                                <td>{{ $item['total'] }}</td>
                                @php $total += $item['total'] @endphp
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">العربة خالية</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    @if ($items)
                        <tr>
                            <th colspan="4"></th>
                            <th>{{ $total }}</th>
                        </tr>
                    @endif
                </tfoot>
            </table>
        </div>
        <form action="{{ route('pay') }}" method="POST">
            @csrf
            <div class="row text-right">
                <div class="col-6">
                    <div class="form-group">
                        <label for="name">الاسم بالكامل</label>
                        <input type="text" class="form-control" name="name" id="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <input type="hidden" name="total" value="{{ $total }}">
                <div class="col-6">
                    <div class="form-group">
                        <label for="phone">رقم الهاتف</label>
                        <input type="text" class="form-control" name="phone" id="phone">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="address1">العنوان 1</label>
                        <input type="text" class="form-control" name="address1" id="address1">
                        @error('address1')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="address2">العنوان 2</label>
                        <input type="text" class="form-control" name="address2" id="address2">
                        @error('address2')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="address3">العنوان 3</label>
                        <input type="text" class="form-control" name="address3" id="address3">
                        @error('address3')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="card_number">رقم البطاقة</label>
                        <input type="text" class="form-control" name="card_number" id="card_number">
                        @error('card_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="password">كلمة المرور</label>
                        <input type="password" class="form-control" name="password" id="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <input class="btn btn-warning btn-lg btn-block mt-lg-4" type="submit" value="دفع">
        </form>
    </div>
@endsection
