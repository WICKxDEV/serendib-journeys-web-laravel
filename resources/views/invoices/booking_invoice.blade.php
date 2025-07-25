<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Invoice</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #333; }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            background: #fff;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        .text-right { text-align: right; }
    </style>
</head>
<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <h2>Booking Invoice</h2>
                <b>Invoice #:</b> {{ $booking->id }}<br>
                <b>Date:</b> {{ $booking->created_at->format('Y-m-d') }}<br>
            </td>
        </tr>
        <tr class="details">
            <td colspan="2">
                <b>Customer:</b> {{ $booking->guest_name ?? ($booking->user->name ?? '') }}<br>
                <b>Email:</b> {{ $booking->guest_email ?? ($booking->user->email ?? '') }}<br>
                <b>Phone:</b> {{ $booking->guest_phone ?? ($booking->user->phone ?? '') }}<br>
            </td>
        </tr>
        <tr class="heading">
            <td>Tour</td>
            <td class="text-right">Date</td>
        </tr>
        <tr class="item">
            <td>{{ $booking->tour->title }}</td>
            <td class="text-right">{{ $booking->booking_date }}</td>
        </tr>
        <tr class="heading">
            <td>Guests</td>
            <td class="text-right">Total Price</td>
        </tr>
        <tr class="item">
            <td>{{ $booking->guests }}</td>
            <td class="text-right">${{ number_format($booking->total_price, 2) }}</td>
        </tr>
        <tr class="total">
            <td></td>
            <td class="text-right">Total: ${{ number_format($booking->total_price, 2) }}</td>
        </tr>
    </table>
    <br>
    <b>Status:</b> {{ ucfirst($booking->status) }}<br>
    <b>Payment Status:</b> {{ ucfirst($booking->payment_status) }}<br>
</div>
</body>
</html> 