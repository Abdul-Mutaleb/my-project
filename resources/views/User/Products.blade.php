<section class="py-5">
  <div class="container">
    <h2 class="mb-5">Trending Products</h2>

    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">

        @php $chunks = $products->chunk(4); @endphp

        @foreach($chunks as $chunkIndex => $chunk)
          <div class="carousel-item @if($chunkIndex == 0) active @endif">
            <div class="row g-4">
              @foreach($chunk as $product)
                <div class="col-md-3">
                  <div class="card border-0 shadow h-100">
                    <img src="{{ $product->product_image ? asset('storage/'.$product->product_image) : 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="{{ $product->product_name }}">
                    <div class="card-body">
                      <h5>{{ $product->product_name }}</h5>
                      <p class="text-muted small">
                        {{ $product->category->category_name ?? 'N/A' }}
                      </p>
                      <p class="fw-bold">Starting from ${{ number_format($product->product_price, 2) }}</p>
                      <a href="{{ Route('User.productDetails') }}" class="btn btn-sm btn-outline-primary mt-2">View Details</a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach

      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</section>
