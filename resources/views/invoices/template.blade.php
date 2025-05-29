<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px 12px; border: 1px solid #ccc; text-align: left; }
    </style>
</head>
<body>
    <h2>Invoice #{{ $user->id }}</h2>
    <p><strong>User:{{ $user->name }}</p>
    <p><strong>Date:5/29/25</p>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Nike Shoes</td>
                <td>2</td>
                <td>Rs 1000</td>
                <td>Rs 2000</td>
            </tr>
            <tr>
                <td>Adidas Shoes</td>
                <td>3</td>
                <td>Rs 2000</td>
                <td>Rs 6000</td>
            </tr>
        </tbody>
    </table>

    <h3>Total: Rs 8000</h3>
</body>
</html>