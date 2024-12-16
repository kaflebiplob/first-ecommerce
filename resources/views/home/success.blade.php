<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Success</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="card p-10">
        <div class="alert alert-success">
            Your Payment has been successfully processed.
        </div>
        <p><strong>Order Id:</strong> {{ $response['order_id'] }}</p>
        <p><strong>Order Status:</strong> {{ $response['order_status'] }}</p>
    </div>
</div>
</body>
</html>