<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/css/app.css')

    <style>
        body{
            background:#fff;
        }
        .success-title{
            font-size:28px;
            font-weight:700;
        }
        .invoice-btn{
            background:#5b3ea4;
            color:#fff;
            border-radius:30px;
            padding:12px 28px;
            border:none;
        }
        .invoice-btn:hover{
            background:#4a318c;
        }
        .summary-table td{
            padding:10px;
        }
        .summary-table tr:nth-child(odd){
            background:#f1f1f1;
        }
    </style>
</head>

<body>
@include('user.header')

<div class="container my-5">

    <!-- SUCCESS MESSAGE -->
    <div class="text-center mb-4">
        <h2 class="success-title">Order Placed Successfully</h2>
        <p>Thank you for Order on our website</p>

        <button onclick="generateInvoice()" class="invoice-btn mt-3">
            Download Invoice
        </button>

        <p class="mt-3 fw-bold">
            Your Order Id is {{ $order->order_id }}
        </p>
    </div>

    <!-- ORDER SUMMARY -->
    <div class="card shadow-sm">
        <div class="card-header fw-bold">
            Order Summary
        </div>
        <div class="card-body p-0">
            <table class="table mb-0 summary-table">
                <tr>
                    <td>Order ID</td>
                    <td class="text-end">{{ $order->order_id }}</td>
                </tr>
                <tr>
                    <td>Product Price</td>
                    <td class="text-end">৳ {{ $order->subtotal }}</td>
                </tr>
                <tr>
                    <td>Discount</td>
                    <td class="text-end">৳ {{ $order->discount ?? 0 }}</td>
                </tr>
                <tr>
                    <td>Delivery Charge</td>
                    <td class="text-end">৳ {{ $order->delivery_charge }}</td>
                </tr>
                <tr>
                    <td><strong>Total Amount</strong></td>
                    <td class="text-end fw-bold">৳ {{ $order->total }}</td>
                </tr>
                <tr>
                    <td>Paid Amount</td>
                    <td class="text-end">৳ 0</td>
                </tr>
                <tr>
                    <td><strong>Due Amount</strong></td>
                    <td class="text-end fw-bold">৳ {{ $order->total }}</td>
                </tr>
            </table>
        </div>
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
const { jsPDF } = window.jspdf;

function generateInvoice() {

    const doc = new jsPDF("p", "pt", "a4");
    const pageWidth = doc.internal.pageSize.getWidth();

    /* ================= HEADER ================= */

    doc.setFont("Helvetica", "bold");
    doc.setFontSize(20);
    doc.text("INVOICE", 40, 40);

    doc.setFontSize(11);
    doc.setFont("Helvetica", "normal");
    doc.text("INVOICE NO : {{ $order->order_id }}", 40, 65);
    doc.text("{{ $order->created_at->format('D M d Y | H:i:s') }}", 40, 85);

    doc.setFont("Helvetica", "bold");
    doc.text("BEAUTYOLOGY", pageWidth - 40, 45, { align: "right" });

    doc.setFont("Helvetica", "normal");
    doc.text("Jigatola, Dhaka, Bangladesh.", pageWidth - 40, 80, { align: "right" });
    doc.text("Shop-1036, Level-01, Shimanto Shomvar,", pageWidth - 40, 65, { align: "right" });
    doc.text("Phone : 09613207207", pageWidth - 40, 95, { align: "right" });

    doc.line(40, 140, pageWidth - 40, 140);

    /* ================= INVOICE TO ================= */

    doc.rect(40, 155, 240, 120);

    doc.setFont("Helvetica", "bold");
    doc.text("INVOICE TO", 50, 175);

    doc.setFont("Helvetica", "normal");
    doc.text("{{ $order->customer_name }}", 50, 195);
    doc.text("Phone : {{ $order->customer_phone }}", 50, 215);
    doc.text("Address : {{ $order->address }}", 50, 235);
    doc.text("Delivery Partner : Pathao", 50, 255);

    /* ================= PRODUCT TABLE ================= */

    let tableX = 300;
    let tableY = 155;
    let rowH = 25;

    doc.setFillColor(230,230,230);
    doc.rect(tableX, tableY, pageWidth - tableX - 40, rowH, "F");

    doc.setFont("Helvetica", "bold");
    doc.text("#", tableX + 10, tableY + 17);
    doc.text("Product", tableX + 30, tableY + 17);
    doc.text("Price", tableX + 230, tableY + 17);
    doc.text("QTY", tableX + 300, tableY + 17);
    doc.text("Total", tableX + 350, tableY + 17);

    let y = tableY + rowH;
    let subtotal = 0;
    let index = 1;

    @foreach($order->products as $product)
        let price = {{ $product->product_price - ($product->discount ?? 0) }};
        let qty = {{ $product->pivot->quantity }};
        let total = price * qty;
        subtotal += total;

        doc.setFont("Helvetica", "normal");
        doc.rect(tableX, y, pageWidth - tableX - 40, rowH);
        doc.text("{{ $loop->iteration }}.", tableX + 10, y + 17);
        doc.text("{{ $product->product_name }}", tableX + 30, y + 17);
        doc.text(price.toString(), tableX + 230, y + 17);
        doc.text(qty.toString(), tableX + 305, y + 17);
        doc.text(total.toString(), tableX + 350, y + 17);

        y += rowH;
    @endforeach

    /* ================= SUMMARY ================= */

    let summaryY = y + 20;

    function row(label, value) {
        doc.rect(pageWidth - 240, summaryY, 200, 25);
        doc.text(label, pageWidth - 230, summaryY + 17);
        doc.text(value, pageWidth - 50, summaryY + 17, { align: "right" });
        summaryY += 25;
    }

    row("Subtotal", subtotal.toString());
    row("Discount", "{{ $order->discount ?? 0 }}");
    row("Delivery Charge", "{{ $order->delivery_charge ?? 0 }}");

    let grandTotal =
        subtotal
        - {{ $order->discount ?? 0 }}
        + {{ $order->delivery_charge ?? 0 }};

    doc.setFont("Helvetica", "bold");
    row("Total", grandTotal.toString());

    row("Paid Amount", "0");
    row("Due Amount", grandTotal.toString());

    /* ================= DUE ================= */

    doc.setFontSize(16);
    doc.rect(300, summaryY + 20, 120, 40);
    doc.text("DUE", 360, summaryY + 47, { align: "center" });

    /* ================= FOOTER ================= */

    doc.setFontSize(10);
    doc.setFont("Helvetica", "normal");
    doc.text("PRINTED BY : {{ auth()->user()->name ?? 'SYSTEM' }}", pageWidth / 2, 760, { align: "center" });
    doc.text("** THIS IS A GENERATED INVOICE, NO NEED TO HAVE SIGNATURE **", pageWidth / 2, 780, { align: "center" });

    doc.save("invoice_{{ $order->order_id }}.pdf");
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</html>
