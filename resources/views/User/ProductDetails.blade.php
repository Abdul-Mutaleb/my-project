<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/css/app.css')

    <style>
        /* Mobile adjustments */
        @media (max-width: 576px) {
            .input-group.mb-3.w-100.w-sm-50.w-lg-25 {
                width: 100% !important;
            }

            .d-flex.gap-3 {
                flex-direction: column;
                gap: 0.5rem !important;
            }

            .btn {
                width: 100%;
            }

            .tab-content {
                margin: 1rem 0;
            }

            .nav.custom-pill-tabs .nav-link {
                font-size: 0.75rem;
                padding: 0.4rem 0.6rem;
            }

            .review-card {
                font-size: 0.75rem;
                padding: 0.5rem;
            }

            .review-form-card input,
            .review-form-card textarea {
                font-size: 0.8rem;
            }

            .related-card {
                width: 160px !important;
                flex-shrink: 0 !important;
            }
        }

        /* Horizontal scroll for related products on mobile */
        .related-scroll {
            display: flex;
            flex-direction: row;
            overflow-x: auto;
            gap: 0.5rem;
            padding-bottom: 0.5rem;
        }

        @media (min-width: 992px) {
            .related-scroll {
                display: block;
                overflow: visible;
            }
        }
    </style>
</head>

<body>

    @include('User.header')

    <div class="container mt-4">

        <div class="row g-4">
            <!-- MAIN PRODUCT CARD -->
            <div class="col-12 col-lg-9">
                <div class="card shadow-sm p-4">
                    <div class="row">
                        <!-- Product Image -->
                        <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                            <div class="position-relative overflow-hidden rounded">
                                <span class="position-absolute top-0 end-0 bg-primary text-white fw-bold text-center"
                                    style="font-size: 1.1rem; padding: 12px 8px; border-radius: 0 0 0 12px; box-shadow: 0 3px 10px rgba(0,0,0,0.25);line-height: 1.1;">
                                    12% <br> OFF
                                </span>
                                <img src="{{ asset('storage/'.$product->product_image) }}" class="w-100"
                                    style="height: 400px; object-fit: cover;" alt="Product Image">
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="col-12 col-lg-6 mt-2">
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

                            <div class="d-flex align-items-center gap-3 my-3 flex-wrap">
                                <span id="finalPrice" class="fs-3 fw-bold">
                                    $ <span id="discountPrice">{{ $discountedPrice }}</span>
                                </span>

                                <span id="originalPrice" class="text-muted text-decoration-line-through">
                                    $ <span id="originalTotal">{{ $product->product_price }}</span>
                                </span>

                                <!-- hidden unit prices -->
                                <input type="hidden" id="unitDiscountPrice" value="{{ $discountedPrice }}">
                                <input type="hidden" id="unitOriginalPrice" value="{{ $product->product_price }}">

                                <div class="input-group mb-3 w-100 w-sm-50 w-lg-25">
                                    <button class="btn bg-secondary" onclick="decreaseQty()">-</button>
                                    <input type="text" id="qty" class="form-control border-black text-center" value="1"
                                        readonly>
                                    <button class="btn bg-secondary" onclick="increaseQty()">+</button>
                                </div>
                            </div>

                            <div class="d-flex gap-3 flex-wrap">
                                <form method="POST" action="{{ route('User.placeOrder') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" id="cartQty" value="1">
                                    <button type="submit" class="btn btn-dark px-4 ">ADD TO CART</button>
                                </form>

                                <a href="{{ route('User.checkout', $product->id) }}" class="btn btn-secondary px-4">
                                    BUY NOW
                                </a>

                            </div>
                            <p class="mt-3">
                                {{ $product->product_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RELATED PRODUCTS -->
            <div class="col-12 col-lg-3">
                <div class="mb-3">
                    <h3 class="fw-bold">Related Products</h3>
                </div>

                <div class="card shadow-sm" style="border-top: 2px solid #ff5733; max-height: 500px;">
                    <div class="card-body p-2 related-scroll">
                        @foreach($relatedProducts as $rel)
                        <div class="related-card p-2 border-bottom" style="min-width: 140px; margin-right: 0.5rem;">
                            <div class="d-flex align-items-center flex-column flex-lg-row gap-2">
                                <img src="{{ asset('storage/'.$rel->product_image) }}" style="width: 100px; height: 100px; object-fit: cover;">
                                <div class="flex-grow-1 d-flex flex-column justify-content-between" style="height:100px;">
                                    <h6 class="mb-1 fw-semibold text-truncate" title="{{ $rel->product_name }}">{{ $rel->product_name }}</h6>
                                    <p class="fw-bold mb-1">${{ $rel->product_price }}</p>
                                    <div class="d-flex gap-1">
                                        <form method="POST" action="{{ route('User.placeOrder') }}" class="flex-grow-1">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $rel->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-sm btn-dark w-100">Cart</button>
                                        </form>
                                        <a href="{{ route('User.checkout', $rel->id) }}" class="btn btn-sm btn-secondary w-100">Buy</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div> <!-- row end -->

        <!-- Product Tabs -->
        <section class="container my-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <ul class="nav custom-pill-tabs text-uppercase">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#description">Description</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#ingredients">Ingredients</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#how">How to Use</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#reviews">Reviews</a></li>
                    </ul>

                    <div class="tab-content mt-3">
                        <div class="tab-pane fade show active m-3" id="description">{{ $product->product_description }}</div>
                        <div class="tab-pane fade m-3" id="ingredients">{!! $product->ingredients ?? 'No ingredients information available.' !!}</div>
                        <div class="tab-pane fade m-3" id="how">{!! $product->how_to_use ?? 'No usage instructions available.' !!}</div>
                        <div class="tab-pane fade m-3" id="reviews">
                            <!-- Review Form -->
                            <div class="review-form-card mb-4">
                                <h6 class="text-center mb-3">Submit a Review</h6>
                                <input type="text" class="form-control mb-2" placeholder="Your Name">
                                <textarea class="form-control mb-3" rows="3" placeholder="Your Review"></textarea>
                                <div class="text-center mb-3">
                                    <span class="star">★ ★ ★ ★ ★</span>
                                </div>
                                <button class="btn btn-primary w-100">Submit Review</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Trending Products -->
        <div class="mt-5">
            @include('User.Products', ['products' => $relatedProducts])
        </div>

    </div>

    @include('User.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Quantity JS -->
    <script>
        const qtyInput = document.getElementById('qty');
        const cartQty = document.getElementById('cartQty');
        const discountPriceEl = document.getElementById('discountPrice');
        const originalPriceEl = document.getElementById('originalTotal');
        const unitDiscountPrice = parseFloat(document.getElementById('unitDiscountPrice').value);
        const unitOriginalPrice = parseFloat(document.getElementById('unitOriginalPrice').value);

        function updatePrices() {
            let qty = parseInt(qtyInput.value);
            discountPriceEl.innerText = (unitDiscountPrice * qty).toFixed(2);
            originalPriceEl.innerText = (unitOriginalPrice * qty).toFixed(2);
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
