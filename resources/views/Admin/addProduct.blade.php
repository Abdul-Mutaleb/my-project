@extends('Admin.mainDashboard')

@section('title', 'Add Product')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-center">Add New Product</h4>
                </div>
                <div class="card-body">

                    {{-- Success Message --}}
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
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
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name"
                                placeholder="Enter product name" value="{{ old('product_name') }}" required>
                        </div>

                        {{-- Category Name --}}
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                            @endforeach
                        </select>

                        {{-- Price --}}
                        <div class="mb-3">
                            <label for="product_price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="product_price" name="product_price"
                                step="0.01" placeholder="Enter price" value="{{ old('product_price') }}" required>
                        </div>

                        {{-- Product Image --}}
                        <div class="mb-3">
                            <label for="product_image" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="product_image" name="product_image">
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" class="btn btn-primary w-100">Add Product</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection