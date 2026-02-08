<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>

<button onclick="generateInvoice()">Download Invoice</button>

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
    doc.text("INVOICE NO : BLG-034218", 40, 65);
    doc.text("TUE FEB 03 2026 | 13:33:38", 40, 85);

    doc.setFont("Helvetica", "bold");
    doc.text("BEAUTYOLOGY", pageWidth - 40, 45, { align: "right" });

    doc.setFont("Helvetica", "normal");
    doc.text("Shop-1036, Level-01, Shimanto Shomvar,", pageWidth - 40, 65, { align: "right" });
    doc.text("Jigatola, Dhaka, Bangladesh.", pageWidth - 40, 80, { align: "right" });
    doc.text("Phone : 09613207207", pageWidth - 40, 95, { align: "right" });
    doc.text("https://beautyology.com.bd/", pageWidth - 40, 110, { align: "right" });
    doc.text("https://facebook.com/beautyology.com.bd", pageWidth - 40, 125, { align: "right" });

    doc.line(40, 140, pageWidth - 40, 140);

    /* ================= INVOICE TO ================= */

    doc.rect(40, 155, 240, 120);

    doc.setFont("Helvetica", "bold");
    doc.text("INVOICE TO", 50, 175);

    doc.setFont("Helvetica", "normal");
    doc.text("Ridoy", 50, 195);
    doc.text("Phone : 01841248209", 50, 215);
    doc.text("Address : Uttara", 50, 235);
    doc.text("Delivery Partner : Pathao", 50, 255);

    /* ================= PRODUCT TABLE ================= */

    const tableX = 300;
    const tableY = 155;
    const rowH = 25;

    // Header background
    doc.setFillColor(230, 230, 230);
    doc.rect(tableX, tableY, pageWidth - tableX - 40, rowH, "F");

    doc.setFont("Helvetica", "bold");
    doc.text("#", tableX + 10, tableY + 17);
    doc.text("Product", tableX + 30, tableY + 17);
    doc.text("Price", tableX + 220, tableY + 17);
    doc.text("QTY", tableX + 290, tableY + 17);
    doc.text("Total", tableX + 340, tableY + 17);

    // Product row
    doc.setFont("Helvetica", "normal");
    doc.rect(tableX, tableY + rowH, pageWidth - tableX - 40, rowH);

    doc.text("1.", tableX + 10, tableY + rowH + 17);
    doc.text("Barmiz Thanaka Pack - 140g", tableX + 30, tableY + rowH + 17);
    doc.text("1250", tableX + 220, tableY + rowH + 17);
    doc.text("1", tableX + 300, tableY + rowH + 17);
    doc.text("1250", tableX + 345, tableY + rowH + 17);

    /* ================= SUMMARY BOX ================= */

    let sumY = tableY + rowH * 3;

    function summaryRow(label, value) {
        doc.rect(pageWidth - 240, sumY, 200, 25);
        doc.text(label, pageWidth - 230, sumY + 17);
        doc.text(value, pageWidth - 50, sumY + 17, { align: "right" });
        sumY += 25;
    }

    summaryRow("Subtotal", "1250");
    summaryRow("Discount", "160");
    summaryRow("Delivery Charge", "70");

    doc.setFont("Helvetica", "bold");
    summaryRow("Total", "1160");

    summaryRow("Paid Amount", "0");
    summaryRow("Due Amount", "1160");

    /* ================= DUE BOX ================= */

    doc.setFontSize(16);
    doc.rect(300, sumY + 20, 120, 40);
    doc.text("DUE", 360, sumY + 47, { align: "center" });

    doc.setFontSize(10);
    doc.setFont("Helvetica", "normal");
    doc.text(
        "PAYABLE AMOUNT : ONE THOUSAND ONE HUNDRED SIXTY TAKA ONLY",
        300,
        sumY + 80
    );

    /* ================= FOOTER ================= */

    doc.text("PRINTED BY : RIDOY", pageWidth / 2, 760, { align: "center" });
    doc.text("PRINTED AT : TUE FEB 03 2026 13:37:39", pageWidth / 2, 775, { align: "center" });
    doc.text("** THIS IS A GENERATED INVOICE, NO NEED TO HAVE SIGNATURE **", pageWidth / 2, 795, { align: "center" });

    doc.save("invoice.pdf");
}
</script>

</body>
</html>
