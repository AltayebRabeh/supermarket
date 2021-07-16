@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header d-flex">{{ __('المستخدمين') }}
                    <a href="javascript:void();" onclick="window.print();"
                        class="mr-auto btn btn-success btn-sm print">طباعة</a>
                    <a class="btn btn-primary btn-sm mr-auto" href="{{ route('register.show') }}">مستخدم جديد</a>
                </div>

                <div class="card-body">
                    <div class="teble-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>اسم المستخدم</td>
                                    <td>البريد الالكتروني</td>
                                    <td>الصلاحية</td>
                                    <td>تاريخ الاضافة</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->permission }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <a href="{{ route('user.edit', $user->id) }}"
                                                class="btn btn-warning btn-sm">تعديل</a>
                                            @if ($user->id != 1)
                                                <a href="javascript:void()"
                                                    onclick="if(confirm('هل تريد الحذف')){document.getElementById('user-{{ $user->id }}').submit();};"
                                                    class="btn btn-danger btn-sm">حذف</a>
                                            @endif
                                            <form action="{{ route('user.destroy', $user->id) }}"
                                                id="user-{{ $user->id }}" method="POST">@csrf</form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">لايوجد نتائج</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        {!! $users->links() !!}
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
