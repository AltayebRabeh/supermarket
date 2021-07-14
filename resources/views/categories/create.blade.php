@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">{{ __('إضافة صنف') }}
                    <a class="btn btn-primary btn-sm mr-auto" href="{{ route('categories') }}">رجوع</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">إسم الصنف</label>
                            <input type="text" class="form-control" name="name" id="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">وصف الصنف</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="submit" value="حفظ" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
