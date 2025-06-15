<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Invoice - {{ $salesItem->item->name ?? 'Item' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7f9;
            color: #333;
            padding: 30px;
        }

        .invoice-box {
            max-width: 850px;
            margin: auto;
            padding: 40px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .invoice-box header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 15px;
        }

        .company-logo h2 {
            color: #007bff;
            margin: 0;
        }

        .company-address {
            text-align: right;
            font-size: 14px;
            color: #777;
        }

        .invoice-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .invoice-title h3 {
            margin: 0;
            color: #222;
            font-size: 26px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 30px;
            font-size: 15px;
        }

        .info-table td {
            padding: 6px 0;
        }

        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .item-table th {
            background: #007bff;
            color: #fff;
            padding: 12px;
            text-align: left;
        }

        .item-table td {
            padding: 12px;
            border-bottom: 1px solid #eaeaea;
        }

        .item-table tfoot td {
            font-weight: bold;
        }

        .footer {
            text-align: center;
            color: #777;
            font-size: 13px;
            border-top: 1px dashed #ccc;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">

        <header>
            <div class="company-logo">
                <img src="{{ $salesItem->user->merchant->logo_url ?? '' }}" alt="company logo" />
                <h2>MyCompany</h2>
            </div>
            <div class="company-address">
                <p>Address: {{ $salesItem->user->merchant->address ?? 'N/A' }}</p>
                <p>Email Addr.: {{ $salesItem->user->merchant->email ?? 'N/A' }}</p>
            </div>
        </header>

        <div class="invoice-title">
            <h3>Invoice</h3>
            <p>Invoice ID: <strong>{{ $salesItem->soi_id }}</strong></p>
        </div>

        <table class="info-table">
            <tr style="text-align: center;">
                <td><strong>Customer Name:</strong> {{ $salesItem->customer_name }}</td>
                <td><strong>Email:</strong> {{ $salesItem->customer_email }}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><strong>Date:</strong> {{ $salesItem->created_at->format('d M, Y') }}</td>
            </tr>
        </table>

        <table class="item-table">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $salesItem->item->name ?? 'N/A' }}</td>
                    <td>{{ $salesItem->quantity }}</td>
                    <td>{{ number_format($salesItem->unit_price ?? $salesItem->item->selling_price, 2) }}</td>
                    <td>
                        {{ number_format($salesItem->quantity * ($salesItem->unit_price ?? $salesItem->item->selling_price), 2) }}
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align:right;">Grand Total</td>
                    <td>
                        {{ number_format($salesItem->quantity * ($salesItem->unit_price ?? $salesItem->item->selling_price), 2) }}
                    </td>
                </tr>
            </tfoot>
        </table>

        <div class="footer">
            <p>Thank you for choosing Swfitcare. For inquiries, contact support@swiftcare.com</p>
        </div>
    </div>
</body>
</html>
