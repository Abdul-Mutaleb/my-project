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

<div class="container my-5">

    <div class="row bg-white shadow rounded-4 p-4">

        <!-- LEFT IMAGE -->
        <div class="col-md-5 position-relative">
            <span class="badge bg-danger position-absolute top-0 end-0 m-3">{{ $product->discount }}% OFF</span>

            <img src="{{ asset('images/'.$product->product_image) }}" width="100%" class="img-fluid rounded mb-3">
            <p>
                {{ $product->product_description }}
            </p>

        </div>

        <!-- RIGHT DETAILS -->
        <div class="col-md-7">

            <h4 class="fw-bold">{{ $product->product_name }}</h4>

            <div class="mb-2">
                ⭐⭐⭐⭐⭐ <strong>4.38</strong> <small>(21 reviews)</small>
            </div>

            <p class="text-success fw-semibold">2675 sold in last 15 days</p>

            <div class="bg-light p-2 rounded mb-3">
                👁 92 people watching this right now
            </div>

            <table class="table table-sm w-75">
                <tr><td>Product Code</td><td>: {{ $product->product_number }}</td></tr>
                <tr><td>Brand</td><td>: Mutaleb</td></tr>
                <tr><td>Status</td><td>: <span class="text-success">In Stock</span></td></tr>
            </table>

            <div class="d-flex align-items-center gap-3 my-3">

                <span id="finalPrice" class="fs-3 fw-bold">
                    ৳ <span id="discountPrice">{{ $discountedPrice }}</span>
                </span>

                <span id="originalPrice" class="text-muted text-decoration-line-through">
                    ৳ <span id="originalTotal">{{ $product->product_price }}</span>
                </span>

                <!-- hidden unit prices -->
                <input type="hidden" id="unitDiscountPrice" value="{{ $discountedPrice }}">
                <input type="hidden" id="unitOriginalPrice" value="{{ $product->product_price }}">

            </div>

            <!-- QUANTITY -->
            <div class="input-group w-25 mb-3">
                <button class="btn btn-outline-secondary" onclick="decreaseQty()">-</button>
                <input type="text" id="qty" class="form-control text-center" value="1" readonly>
                <button class="btn btn-outline-secondary" onclick="increaseQty()">+</button>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="d-flex gap-3">
                <form method="POST" action="{{ route('User.placeOrder') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="1">
                    <input type="hidden" name="quantity" id="cartQty" value="1">
                    <button type="submit" class="btn btn-dark px-4">ADD TO CART</button>
                </form>

                <a href="#" class="btn btn-secondary px-4">BUY NOW</a>
            </div>
        </div>
    </div>


    <!-- TABS -->
    <div class="bg-white shadow rounded-4 p-4 mt-4">

        <ul class="nav nav-pills mb-3">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#desc">Description</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#ing">Ingredients</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#use">How to Use</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#rev">Reviews</button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="desc">
                Natural Thanaka face pack that brightens and cools skin.
            </div>
            <div class="tab-pane fade" id="ing">Thanaka powder, herbal extracts</div>
            <div class="tab-pane fade" id="use">Apply evenly and wash after 15 minutes</div>
            <div class="tab-pane fade" id="rev">⭐⭐⭐⭐⭐ Amazing product!</div>
        </div>

    </div>

</div>

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
