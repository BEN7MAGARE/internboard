@extends('layouts.main')

@section('title')
    Marketplace @parent
@endsection

@section('content')
    <main class="main">

        <div class="page-title mt-5" data-aos="fade">
            <div class="heading">
                <div class="container-fluid mb-4">
                    <form action="{{ route('market.search') }}" method="get">
                        <div class="row ">

                            <div class="col-md-3">
                                <div class="input-group">
                                    <select name="supplier" id="supplier" class="form-control">
                                        <option value="">Search by Supplier</option>
                                        @foreach ($corporates as $corporate)
                                            <option value="{{ $corporate->id }}">{{ $corporate->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group">
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Search by Category</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group">
                                    <select name="brand" id="brand" class="form-control">
                                        <option value="">Search by Brand</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="search">
                                    &nbsp;&nbsp;
                                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                @foreach ($products as $product)
                    @php
                        $images = json_decode($product->image, true);
                    @endphp
                    <div class="col-md-3 mb-2">
                        <div class="card">
                            <img src="{{ asset('productimages/' . @$images[0]) }}" class="card-img-top img-fluid"
                                alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}
                                    @if (!is_null($product->price))
                                        <span class="float-end text-primary">{{ number_format($product->price, 2) }}</span>
                                    @endif
                                </h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <a href="#" class="btn btn-primary btn-sm" data-productid="{{ $product->id }}"
                                    id="editProductToggle"><i class="bi bi-pencil-square"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" data-productid="{{ $product->id }}"
                                    id="deleteProductToggle"><i class="bi bi-trash"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <section id="product-pagination" class="product-pagination section mt-3 bg-white p-2">
                <div class="container">
                    <div class="d-flex justify-content-center" id="productPagination">
                        <ul>
                            {!! $products->links() !!}
                        </ul>
                    </div>
                </div>
            </section>
        </div>

    </main>
@endsection

@section('header_scripts')
    <script src="{{ asset('js/market.js') }}"></script>
@endsection
