@extends('Admin.mainDashboard')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <h5 class="mb-0">Product List</h5>
            <a href="{{ route('Admin.addProduct') }}" class="btn btn-light btn-sm">
                + Add Product
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Product No</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($products as $key => $product)
                        <tr>
                            <td>{{ $key + 1 }}</td>

                            <td>
                                @if($product->product_image)
                                <img src="{{ asset('storage/'.$product->product_image) }}" width="60" height="60"
                                    class="rounded border">
                                @else
                                <span class="text-muted">No Image</span>
                                @endif
                            </td>

                            <td>{{ $product->product_number }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ optional($product->category)->category_name ?? 'N/A' }}</td>
                            <td>
                                <span class="fw-bold text-success">
                                    ৳{{ number_format($product->product_price, 2) }}
                                </span>
                            </td>

                            <td>
                                {{-- Edit Button --}}
                                <a href="" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Delete Button --}}
                                <form action="{{ route('Admin.productDelete', $product->id) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-muted">
                                No products found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection