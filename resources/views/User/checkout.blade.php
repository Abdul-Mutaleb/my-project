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

    <div class="row g-4">

        <!-- LEFT : DELIVERY DETAILS -->
        <div class="col-lg-8">
            <div class="card shadow-sm p-4">
                <h5 class="fw-bold mb-3">Delivery Details</h5>

                <form method="POST" action="{{ route('User.placeOrder') }}">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" id="qty" value="1">
                    <input type="hidden" name="delivery_charge" id="deliveryCharge" value="70">
                    <input type="hidden" name="total" id="finalTotal">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Name (নাম)</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label>Phone Number (মোবাইল নাম্বার)</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Delivery Address (ঠিকানা)</label>
                        <textarea class="form-control" rows="3" name="address" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">ডেলিভারি চার্জ</label><br>

                        <input type="radio" name="delivery" checked onclick="setDelivery(70)">
                        ঢাকা সিটির ভিতরে - ৭০ টাকা <br>

                        <input type="radio" name="delivery" onclick="setDelivery(130)">
                        ঢাকা সিটির বাইরে - ১৩০ টাকা
                    </div>

                    <button type="submit" class="btn btn-primary w-50">
                        অর্ডার করুন (<span id="btnTotal"></span>)
                    </button>
                </form>
            </div>
        </div>

        <!-- RIGHT : CART SUMMARY -->
        <div class="col-lg-4">
            <div class="card shadow-sm p-4">

                <h5 class="fw-bold mb-3">Cart Summary</h5>

                <table class="table table-sm">
                    <tr>
                        <td>Quantity</td>
                        <td class="text-end">1</td>
                    </tr>
                    <tr>
                        <td>Product Price</td>
                        <td class="text-end">৳ {{ $product->product_price }}</td>
                    </tr>
                    <tr>
                        <td>Discount</td>
                        <td class="text-end">৳ {{ $discount }}</td>
                    </tr>
                    <tr>
                        <td>Coupon Discount</td>
                        <td class="text-end">৳ 0</td>
                    </tr>
                    <tr>
                        <td>Subtotal Price</td>
                        <td class="text-end">৳ {{ $discountedPrice }}</td>
                    </tr>
                    <tr>
                        <td>Delivery Charge</td>
                        <td class="text-end">৳ <span id="deliveryView">70</span></td>
                    </tr>
                    <tr class="fw-bold border-top">
                        <td>Total</td>
                        <td class="text-end">৳ <span id="totalView"></span></td>
                    </tr>
                </table>

                <div class="mt-3">
                    <label>Do you have a coupon code?</label>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <button class="btn btn-secondary">Apply</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- PRODUCT PREVIEW -->
    <div class="card shadow-sm p-4 mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img src="{{ asset('images/'.$product->product_image) }}" width="50">
                        {{ $product->product_name }}
                    </td>
                    <td>৳ {{ $discountedPrice }}</td>
                    <td>1</td>
                    <td class="text-end">৳ {{ $discountedPrice }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<script>
    const subtotal = {{ $discountedPrice }};
    let delivery = 70;

    function setDelivery(amount) {
        delivery = amount;
        document.getElementById('deliveryView').innerText = amount;
        updateTotal();
    }

    function updateTotal() {
        let total = subtotal + delivery;
        document.getElementById('totalView').innerText = total;
        document.getElementById('btnTotal').innerText = total;
        document.getElementById('finalTotal').value = total;
    }

    updateTotal();
</script>


</body>

</html>