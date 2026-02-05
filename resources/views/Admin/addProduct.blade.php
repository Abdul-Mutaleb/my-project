@extends('Admin.mainDashboard')

@section('title', 'Add Product')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient bg-primary text-white text-center rounded-top-4">
                    <h4 class="mb-0 fw-semibold">Add New Product</h4>
                </div>

                <div class="card-body p-4">

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Product Form --}}
                    <form action="{{ route('Admin.addProductStore') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Product Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">Product Name</label>
                            <input type="text"
                                   class="form-control rounded-3"
                                   name="product_name"
                                   placeholder="Enter product name"
                                   value="{{ old('product_name') }}">
                        </div>

                        {{-- Category --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">Category</label>
                            <select name="category_id" class="form-select rounded-3">
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Price --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">Price</label>
                            <input type="number"
                                   class="form-control rounded-3"
                                   name="product_price"
                                   step="0.01"
                                   placeholder="Enter price"
                                   value="{{ old('product_price') }}">
                        </div>

                        {{-- Image --}}
                        <div class="mb-4">
                            <label class="form-label fw-medium">Product Image</label>
                            <input type="file"
                                   class="form-control rounded-3"
                                   name="product_image">
                            <small class="text-muted">JPG, PNG (Max 2MB)</small>
                        </div>

                        {{-- Button --}}
                        <button type="submit"
                                class="btn btn-primary w-100 py-2 fw-semibold rounded-3">
                            <i class="fas fa-plus-circle me-1"></i> Add Product
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
