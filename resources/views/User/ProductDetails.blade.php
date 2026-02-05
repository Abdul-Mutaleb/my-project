<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/css/app.css')
</head>

<body>

    @include('User.header')

    <div class="container mt-4">
        <!-- Product Details + Related Products Row -->
        <div class="row g-4">
            <!-- MAIN PRODUCT CARD -->
            <div class="col-lg-9">
                <div class="card shadow-sm p-4">
                    <div class="row">
                        <!-- Product Image + Description -->
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="position-relative overflow-hidden rounded">
                                <span class="position-absolute top-0 end-0 bg-primary text-white fw-bold text-center"
                                    style="font-size: 1.1rem; padding: 12px 8px; border-radius: 0 0 0 12px; box-shadow: 0 3px 10px rgba(0,0,0,0.25);line-height: 1.1;">
                                    12% <br> OFF
                                </span>

                                <img src="{{ asset('storage/'.$product->product_image) }}" class="w-100"
                                    style="height: 350px; object-fit: cover;">
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <h4 class="fw-bold fs-5">{{ $product->product_name }}</h4>
                            <div class="mb-2 fs-10">
                                ⭐⭐⭐⭐⭐ <strong>4.38</strong> <small>(21 reviews)</small>
                            </div>
                            <p class="text-success fs-10 fw-semibold">2675 sold in last 15 days</p>
                            <div class="bg-light p-2 rounded mb-3 fs-10">
                                👁 92 people watching this right now
                            </div>

                            <table class="table table-sm w-75 fs-10">
                                <tr>
                                    <td>Product Code</td>
                                    <td>: {{ $product->product_number }}</td>
                                </tr>
                                <tr>
                                    <td>Brand</td>
                                    <td>: Thiland</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>: <span class="text-success">In Stock</span></td>
                                </tr>
                            </table>

                            <div class="d-flex align-items-center gap-3 my-3">
                                <span id="finalPrice" class="fs-5 fw-bold">
                                    $ <span id="discountPrice">{{$product-> product_price  }}</span>
                                </span>
                                <span id="originalPrice" class="text-muted text-decoration-line-through fs-10">
                                    $ <span id="originalTotal">{{ $discountedPrice}}</span>
                                </span>
                                <div class="input-group w-25 mb-3">
                                    <button class="btn bg-secondary" onclick="decreaseQty()">-</button>
                                    <input type="text" id="qty" class="form-control border-black text-center" value="1"
                                        readonly>
                                    <button class="btn bg-secondary" onclick="increaseQty()">+</button>
                                </div>
                            </div>

                            <div class="d-flex gap-3">
                                <form method="POST" action="{{ route('User.placeOrder') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" id="cartQty" value="1">
                                    <button type="submit" class="btn btn-dark px-4">ADD TO CART</button>
                                </form>

                                <a href="#" class="btn btn-secondary px-4">BUY NOW</a>
                            </div>
                            <p class="mt-3">
                                {{ $product->product_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RELATED PRODUCTS -->
            <div class="col-lg-3">
                <div class="mb-3">
                    <h3 class="fw-bold">Related Products</h3>
                </div>
                <div class="card shadow-sm" style="border-top: 2px solid #ff5733; max-height: 500px; overflow-y: auto;">
                    <div class="card-body p-2 related-scroll">
                        @foreach($relatedProducts as $rel)
                        <div class="d-flex flex-column mb-3 related-card p-2 border-bottom" style="height: 100px;">
                            <div class="d-flex align-items-center">
                                <!-- Image -->
                                <div class="flex-shrink-0 me-2" style="width: 100px; height: 100px;">
                                    <img src="{{ asset('storage/'.$rel->product_image) }}" class="w-100 h-100"
                                        style="object-fit: cover;">
                                </div>

                                <!-- Title & Price -->
                                <div class="flex-grow-1 ms-2 d-flex flex-column justify-content-between"
                                    style="height: 100px;">
                                    <div>
                                        <h6 class="mb-1 fw-semibold text-truncate" title="{{ $rel->product_name }}">
                                            {{ $rel->product_name }}</h6>
                                        <div class="related-price text-muted">
                                            <span class="text-dark fw-bold">${{ $rel->discount_price }}</span>
                                            <small
                                                class="text-decoration-line-through ms-1">${{ $rel->product_price }}</small>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="d-flex gap-2">
                                        <form method="POST" action="{{ route('User.placeOrder') }}" class="flex-grow-1">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $rel->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit"
                                                class="btn btn-sm btn-dark w-100 text-nowrap round-start"
                                                style="font-size: .75rem;">
                                                Add to Cart
                                            </button>
                                        </form>
                                        <a href="{{ route('User.productDetails', $rel->id) }}"
                                            class="btn btn-sm btn-secondary w-100 text-nowrap round-end"
                                            style="font-size: .75rem;">
                                            Buy Now
                                        </a>
                                    </div>


                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div> <!-- row end -->
        <section class="container my-5">
            <div class="card shadow-sm">
                <div class="card-body">

                    <!-- ===== Tabs Navigation ===== -->
                    <div class="tab-center-wrapper">
                        <ul class="nav custom-pill-tabs text-uppercase">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#description">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#ingredients">Ingredients</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#how">How to Use</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#reviews">Reviews</a>
                            </li>
                        </ul>
                    </div>

                    <!-- ===== Tabs Content ===== -->
                    <div class="tab-content mt-3">

                        <!-- Description -->
                        <div class="tab-pane fade show active m-5" id="description">
                            {{ $product->product_description }}

                        </div>

                        <!-- Ingredients -->
                        <div class="tab-pane fade" id="ingredients">
                            <p class="small">
                                {!! $product->ingredients ?? 'No ingredients information available.' !!}
                            </p>
                        </div>

                        <!-- How to Use -->
                        <div class="tab-pane fade" id="how">
                            <p class="small">
                                {!! $product->how_to_use ?? 'No usage instructions available.' !!}
                            </p>
                        </div>

                        <!-- Reviews -->
                        <div class="tab-pane fade" id="reviews">

                            <!-- Review Form -->
                            <div class="review-form-card mb-4">
                                <h6 class="text-center mb-3">Submit a Review</h6>
                                <div class="upload-box mb-3">
                                    <i class="bi bi-image"></i>
                                </div>
                                <input type="text" class="form-control mb-2" placeholder="Your Name">
                                <textarea class="form-control mb-3" rows="3" placeholder="Your Review"></textarea>
                                <div class="text-center mb-3">
                                    <span class="star">★ ★ ★ ★ ★</span>
                                </div>
                                <button class="btn btn-primary w-100">Submit Review</button>
                            </div>

                            <!-- Review Cards -->
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="review-card">
                                        <strong>Tomosha Chakraborty</strong>
                                        <div class="stars">★★★★★</div>
                                        <p>Best acne & acne spot reducing combo</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="review-card">
                                        <strong>Ashfia</strong>
                                        <div class="stars">★★★★★</div>
                                        <p>Budget friendly & effective combo</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="review-card">
                                        <strong>Silvia</strong>
                                        <div class="stars">★★★★★</div>
                                        <p>Best acne controlling combo</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="review-card">
                                        <strong>Rodeyla Binte Anwar</strong>
                                        <div class="stars">★★★★☆</div>
                                        <p>Using this combo for 4 months</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Bootstrap JS (required for tabs to work) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- TRENDING PRODUCTS -->
        <div class="mt-5">
            @include('user.products')
        </div>

    </div> <!-- container end -->


    <script>
    const qtyInput = document.getElementById('qty');
    const cartQty = document.getElementById('cartQty');

    const discountPriceEl = document.getElementById('discountPrice');
    const originalPriceEl = document.getElementById('originalTotal');

    const unitDiscountPrice = parseFloat(document.getElementById('unitDiscountPrice').value);
    const unitOriginalPrice = parseFloat(document.getElementById('unitOriginalPrice').value);

    function updatePrices() {
        let qty = parseInt(qtyInput.value);

        let discountTotal = unitDiscountPrice * qty;
        let originalTotal = unitOriginalPrice * qty;

        discountPriceEl.innerText = discountTotal;
        originalPriceEl.innerText = originalTotal;

        cartQty.value = qty;
    }

    function increaseQty() {
        let qty = parseInt(qtyInput.value);
        qty++;
        qtyInput.value = qty;
        updatePrices();
    }

    function decreaseQty() {
        let qty = parseInt(qtyInput.value);
        if (qty > 1) {
            qty--;
            qtyInput.value = qty;
            updatePrices();
        }
    }
    </script>
</body>
</html>