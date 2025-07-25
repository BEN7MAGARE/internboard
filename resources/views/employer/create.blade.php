@extends('layouts.dashboard')

@section('title')
    Create Business @parent
@endsection
@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
@endsection

@section('subtitle')
    Create Business
@endsection

@section('content')
    <main class="main">
        <section class="mt-2 p-2">
            <div class="card mb-5 radius-image p-2">

                <div class="card-header">
                    <h4 class="mb-2"><strong>Add Your Company/Business Details</strong></h4>
                </div>

                <form action="{{ route('employer.store') }}" method="post" id="corporateCreateForm">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="id" id="corporateID" value="{{ auth()->user()->corporate?->id }}">
                            <div class="col-md-6 mt-2">
                                <label for="companyIndustry">Company Industry</label>
                                <select name="category_id" id="companyIndustry"
                                    class="form-select @error('category_id') invalid-input:'' @enderror" required>
                                    <option value="">Select Industry</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ auth()->user()->corporate?->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="companyName">Company Name</label>
                                <input type="text" class="form-control @error('name') invalid-input:'' @enderror"
                                    name="name" id="companyName" value="{{ auth()->user()->corporate?->name }}" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="companySize">Company Size / Number of Employees</label>
                                <select name="size" id="companySize"
                                    class="form-select @error('size') invalid-input:'' @enderror">
                                    <option value="">Select Size</option>
                                    <option value="1-10"
                                        {{ auth()->user()->corporate?->size == '1-10' ? 'selected' : '' }}>1-10</option>
                                    <option value="11-50"
                                        {{ auth()->user()->corporate?->size == '11-50' ? 'selected' : '' }}>11-50</option>
                                    <option value="51-100"
                                        {{ auth()->user()->corporate?->size == '51-100' ? 'selected' : '' }}>51-100
                                    </option>
                                    <option value="101-500"
                                        {{ auth()->user()->corporate?->size == '101-500' ? 'selected' : '' }}>101-500
                                    </option>
                                    <option value="501-1000"
                                        {{ auth()->user()->corporate?->size == '501-1000' ? 'selected' : '' }}>501-1000
                                    </option>
                                    <option value="1001+"
                                        {{ auth()->user()->corporate?->size == '1001+' ? 'selected' : '' }}>1001+</option>
                                </select>
                                @error('size')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="logo">Logo</label>
                                <input type="file" class="form-control @error('logo') invalid-input:'' @enderror"
                                    name="logo" id="logo" autocomplete="logo">
                                @error('logo')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="email">Company Email</label>
                                <input type="email" class="form-control @error('email') invalid-input:'' @enderror"
                                    name="email" id="companyEmail" required value="{{ auth()->user()->corporate?->email }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="phone">Company Phone</label>
                                <input type="text" class="form-control @error('phone') invalid-input:'' @enderror"
                                    name="phone" id="companyPhone" required
                                    value="{{ auth()->user()->corporate?->phone }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="address">Company Address/Street/HQ</label>
                                <input type="text" class="form-control @error('address') invalid-input:'' @enderror"
                                    name="address" id="companyAddress" required
                                    value="{{ auth()->user()->corporate?->address }}">
                                @error('address')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="natureOfBusiness">Nature of Business</label>
                                <select name="nature_of_business" id="natureOfBusiness"
                                    class="form-select @error('nature_of_business') invalid-input:'' @enderror">
                                    <option value="">Select Nature of Business</option>
                                    <option value="Trading"
                                        {{ auth()->user()->corporate?->nature_of_business == 'Trading' ? 'selected' : '' }}>Trading
                                    </option>
                                    <option value="Service"
                                        {{ auth()->user()->corporate?->nature_of_business == 'Service' ? 'selected' : '' }}>Service
                                    </option>
                                    <option value="Manufacturing"
                                        {{ auth()->user()->corporate?->nature_of_business == 'Manufacturing' ? 'selected' : '' }}>Manufacturing
                                    </option>
                                </select>
                                @error('nature_of_business')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="website">Company Website</label>
                                <input type="text" class="form-control @error('website') invalid-input:'' @enderror"
                                    name="website" id="website" required
                                    value="{{ auth()->user()->corporate?->website }}">
                                @error('website')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="description">Company Description</label>
                                <input type="text" name="description" id="description"
                                    class="form-control @error('description') invalid-input:'' @enderror" value="{{ auth()->user()->corporate?->description }}">
                                @error('description')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-2">
                                <label for="mission_vision">Company Mission/Vision</label>
                                <input type="text" name="mission_vision" id="mission_vision"
                                    class="form-control @error('mission_vision') invalid-input:'' @enderror" value="{{ auth()->user()->corporate?->mission_vision }}">
                                @error('mission_vision')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                        </div>
                        
                    </div>

                    <div id="corporateFeedback"></div>

                    <div class="card-footer  text-end p-2">
                        <button type="submit" class="btn btn-primary btn-md" id="corporateCreateSubmit"><i
                                class="fa fa-server"></i> Submit </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/corporate.js') }}"></script>
@endsection
