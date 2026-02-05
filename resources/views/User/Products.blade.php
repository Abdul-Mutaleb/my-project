<section class="py-5">
  <div class="container">
    <h3 class="mb-4">Related Products</h3>

    <div class="row g-4">
      @forelse($products as $product)
        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
          <div class="card border-0 shadow h-100">
            <img src="{{ $product->product_image ? asset('storage/'.$product->product_image) : 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="{{ $product->product_name }}">
            <div class="card-body">
              <h5 class="text-truncate">{{ $product->product_name }}</h5>
              <p class="text-muted small">{{ $product->category->category_name ?? 'N/A' }}</p>
              <p class="fw-bold">Starting from ${{ number_format($product->product_price, 2) }}</p>
              <a href="{{ route('User.productDetails', $product->id) }}" class="btn btn-sm btn-outline-primary mt-2 w-100">View Details</a>
            </div>
          </div>
        </div>
      @empty
        <p class="text-muted">No related products found.</p>
      @endforelse
    </div>
  </div>
</section>
