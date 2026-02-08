<div class="card shadow-sm p-4">

    <h5 class="fw-bold mb-3">Cart Summary</h5>

    <table class="table table-sm">
        <tr>
            <td>Quantity</td>
            <td class="text-end">
                <input type="number" id="quantityInput" value="1" min="1" class="form-control text-end"
                    style="width:80px;" onchange="updateQuantity(this.value)">
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

    <div class="mt-3 text-center">
        <button type="submit" class="btn btn-primary w-50">
            অর্ডার করুন (<span id="btnTotal2"></span>৳)
        </button>
    </div>

</div>

