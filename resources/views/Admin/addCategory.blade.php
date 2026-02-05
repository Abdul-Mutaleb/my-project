@extends('Admin.mainDashboard')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Add New Category</h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('Admin.addCategoryStore') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="category_name " class="form-label">Category Name <span class="color-danger">*</span></label>
                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter category name" value="{{ old('category_name') }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

