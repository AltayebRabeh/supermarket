@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h2 class="my-4">بحث عن ' {{ $search }} '</h2>
        <div class="gr">
            @foreach ($products as $product)
                <div class="card">
                    <img src="{{ asset($product->image) }}" style="height:200px" class="card-img-top"
                        alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title d-flex name">{{ $product->name }}</h5>
                        <span class="price">{{ $product->price }} جنيه</span>
                        <input type="number" style="width: 60px" value="1" min="1"
                            class="qty form-control d-inline-block ml-2">
                        <input class="id" type="hidden" value="{{ $product->id }}">
                        <a href="" class="btn btn-primary add-to-card">أضف إلى العربة
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-cart4" viewBox="0 0 16 16">
                                <path
                                    d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mx-5">
            {!! $products->links() !!}
        </div>
    </div>
@endsection
