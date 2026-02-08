<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/css/app.css')

    <style>
        @media (max-width: 767px) {
            .container {
                padding: 1rem;
            }
            .btn {
                width: 100%;
            }
            table td, table th {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    @include('User.header')

    <div class="container my-5">

        <div class="row g-4">


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
                            <div class="col-md-6 mb-2">
                                <label>Name (নাম)</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-md-6 mb-2">
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
                            অর্ডার করুন (<span id="btnTotal"></span>৳)
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                @include('user.cartSummary')
                
            </div>

        </div>


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
                            <img src="{{ asset('storage/'.$product->product_image) }}" width="50">
                            {{ $product->product_name }}
                        </td>
                        <td>৳ {{ $discountedPrice }}</td>
                        <td id="previewQty">1</td>
                        <td class="text-end">৳ <span id="previewSubtotal">{{ $discountedPrice }}</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <script>
        const basePrice = {{ $discountedPrice }};
        let delivery = 70;
        let quantity = 1;

        function setDelivery(amount) {
            delivery = amount;
            document.getElementById('deliveryView').innerText = amount;
            document.getElementById('deliveryCharge').value = amount;
            updateTotal();
        }

        function updateQuantity(value) {
            quantity = parseInt(value) || 1;
            document.getElementById('qty').value = quantity;
            document.getElementById('subtotal').innerText = basePrice * quantity;
            document.getElementById('previewQty').innerText = quantity;
            document.getElementById('previewSubtotal').innerText = basePrice * quantity;
            updateTotal();
        }

        function updateTotal() {
            let total = (basePrice * quantity) + delivery;
            document.getElementById('totalView').innerText = total;
            document.getElementById('btnTotal').innerText = total;
            document.getElementById('btnTotal2').innerText = total;
            document.getElementById('finalTotal').value = total;
        }

        updateTotal();
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>
</html>