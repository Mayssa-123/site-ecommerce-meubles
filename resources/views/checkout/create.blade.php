<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Checkout</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Create New Checkout</h1>
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="text" name="user_id" id="user_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="total_price" class="form-label">Total Price</label>
                <input type="number" name="total_price" id="total_price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="payment_method" class="form-label">Payment Method</label>
                <input type="text" name="payment_method" id="payment_method" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="products" class="form-label">Products</label>
                <textarea name="products" id="products" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</body>
</html>
