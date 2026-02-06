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
                    <button class="btn btn-success mt-3 w-100" id="invoiceBtn">
                        Generate Invoice PDF
                    </button>

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
                <div class="card shadow-sm p-4">

                    <h5 class="fw-bold mb-3">Cart Summary</h5>

                    <table class="table table-sm">
                        <tr>
                            <td>Quantity</td>
                            <td class="text-end">
                                <input type="number" id="quantityInput" value="1" min="1" class="form-control text-end" style="width:80px;" onchange="updateQuantity(this.value)">
                            </td>
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
                            <td class="text-end">৳ <span id="subtotal">{{ $discountedPrice }}</span></td>
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
            document.getElementById('finalTotal').value = total;
        }

        updateTotal();
    </script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


<script>
const { jsPDF } = window.jspdf;

document.getElementById('invoiceBtn').addEventListener('click', () => {
    const doc = new jsPDF('p', 'pt', 'a4'); 
    const pageWidth = doc.internal.pageSize.getWidth();

    doc.setFontSize(18);
    doc.text("Invoice", pageWidth / 2, 40, { align: "center" });
    doc.setFontSize(12);
    doc.line(40, 50, pageWidth - 40, 50);

    const name = document.querySelector('input[name="name"]').value || 'N/A';
    const phone = document.querySelector('input[name="phone"]').value || 'N/A';
    const address = document.querySelector('textarea[name="address"]').value || 'N/A';

    doc.text(`Customer Name: ${name}`, 40, 80);
    doc.text(`Phone: ${phone}`, 40, 100);
    doc.text(`Address: ${address}`, 40, 120);

    const qty = parseInt(document.getElementById('quantityInput').value) || 1;
    const productName = "{{ $product->product_name }}";
    const unitPrice = {{ $discountedPrice }};
    const subtotal = unitPrice * qty;
    const deliveryCharge = delivery;
    const total = subtotal + deliveryCharge;

    const startY = 150;
    doc.setFillColor(230, 230, 230);
    doc.rect(40, startY, pageWidth - 80, 20, 'F'); 
    doc.setTextColor(0);
    doc.text("Product", 50, startY + 14);
    doc.text("Unit Price", 220, startY + 14);
    doc.text("Quantity", 330, startY + 14);
    doc.text("Subtotal", 430, startY + 14);

    const rowY = startY + 20;
    doc.rect(40, rowY, pageWidth - 80, 20);
    doc.text(productName, 50, rowY + 14);
    doc.text(`Tk ${unitPrice}`, 220, rowY + 14);
    doc.text(`${qty}`, 330, rowY + 14);
    doc.text(`Tk ${subtotal}`, 430, rowY + 14);

    const summaryY = rowY + 40;
    doc.text(`Delivery: Tk ${deliveryCharge}`, 350, summaryY);
    doc.setFontSize(14);
    doc.text(`Total: Tk ${total}`, 350, summaryY + 20);

    doc.setFontSize(12);
    doc.setTextColor(100);
    doc.text("Thank you for shopping with us!", pageWidth / 2, 780, { align: "center" });

    doc.save(`Invoice_${productName}.pdf`);
});
</script>



</body>

</html>
