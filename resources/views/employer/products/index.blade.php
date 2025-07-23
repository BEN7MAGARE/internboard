@extends('layouts.dashboard')
@section('title')
    Products
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <style>
        .step-2,
        .step-3 {
            display: none;
        }
    </style>
@endsection

@section('subtitle')
    Products
@endsection

@section('content')
    <main class="main">
        <section class="mt-2 p-2">
            <div class="mb-5 radius-image p-2">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle-fill"></i>&nbsp;<strong>Note:</strong> You can add your products/services/projects/portfolios here for advertisement on our platform
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="text-end mb-4">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductModal"
                        id="addProductToggle">Add Product/Service</a>
                </div>
                <div class="">
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
                                                <span
                                                    class="float-end text-primary">{{ number_format($product->price, 2) }}</span>
                                            @endif
                                        </h5>
                                        <p class="card-text">{{ $product->description }}</p>
                                        <a href="#" class="btn btn-primary btn-sm"
                                            data-productid="{{ $product->id }}" id="editProductToggle"><i
                                                class="bi bi-pencil-square"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm" data-productid="{{ $product->id }}"
                                            id="deleteProductToggle"><i class="bi bi-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="createProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="createProductModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="createProductModalLabel">Create Product/Service/Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('employer.product.store') }}" method="POST" id="createProductForm"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="id" value="" id="productId">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="productName" name="name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="productDescription" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" id="productPrice" name="price">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="images">Images</label>
                                        <input type="file" class="form-control" id="productImages" name="images[]"
                                            multiple>
                                    </div>
                                    <div class="d-flex image-preview flex-wrap" id="imagePreview">

                                    </div>

                                </div>

                            </div>
                            <div id="productFeedback"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/sweetalert.js') }}"></script>
    <script src="{{ asset('js/employer/products.js') }}"></script>
@endsection
