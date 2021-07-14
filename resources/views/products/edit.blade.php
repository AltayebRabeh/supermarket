@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">{{ __('تعديل منتج') }}
                    <a class="btn btn-primary btn-sm mr-auto" href="{{ route('products') }}">رجوع</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">إسم المنتج</label>
                            <input type="text" value="{{ $product->name }}" class="form-control" name="name" id="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">الصنف</label>
                            <select class="form-control" name="category" id="category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }} @if ($category->id ==
                                        $product->category_id) 'selected' @endif">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">السعر</label>
                            <input type="number" value="{{ $product->price }}" class="form-control" name="price"
                                id="price">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="qty">الكمية</label>
                            <input type="number" value="{{ $product->qty }}" class="form-control" name="qty" id="qty">
                            @error('qty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">الصورة</label>
                            <input type="file" class="form-control" name="image" id="image">
                            @error('image')
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
