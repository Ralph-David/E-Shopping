<?php
session_start();
require_once 'config.php';

// Get order ID
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($order_id == 0) {
    header('Location: index.php');
    exit();
}

// Fetch order details
$sql = "SELECT * FROM orders WHERE id = $order_id";
$result = $conn->query($sql);
$order = $result->fetch_assoc();

if (!$order) {
    header('Location: index.php');
    exit();
}

// Fetch order items
$sql_items = "SELECT * FROM order_items WHERE order_id = $order_id";
$items_result = $conn->query($sql_items);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Mart | Order Successful</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <div class="logo">
        <img src="ecomimages/E-Mart.png" alt="E-Mart Logo">
    </div>
</header>

<main class="container">
    <div class="success-message">
        <div class="success-icon">✓</div>
        <h2>Order Placed Successfully!</h2>
        <p>Thank you for your order, <?php echo htmlspecialchars($order['customer_name']); ?>!</p>
        <p class="order-number">Order #<?php echo $order_id; ?></p>
    </div>

    <div class="order-details">
        <h3>Order Details</h3>
        <div class="detail-row">
            <span class="label">Order Date:</span>
            <span class="value"><?php echo date('F j, Y, g:i a', strtotime($order['order_date'])); ?></span>
        </div>
        <div class="detail-row">
            <span class="label">Email:</span>
            <span class="value"><?php echo htmlspecialchars($order['customer_email']); ?></span>
        </div>
        <div class="detail-row">
            <span class="label">Phone:</span>
            <span class="value"><?php echo htmlspecialchars($order['customer_phone']); ?></span>
        </div>
        <div class="detail-row">
            <span class="label">Delivery Address:</span>
            <span class="value"><?php echo nl2br(htmlspecialchars($order['customer_address'])); ?></span>
        </div>
    </div>

    <div class="order-items">
        <h3>Items Ordered</h3>
        <table class="items-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while($item = $items_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                    <td>₱<?php echo number_format($item['price'], 2); ?></td>
                </tr>
                <?php endwhile; ?>
                <tr class="total-row">
                    <td><strong>Total:</strong></td>
                    <td><strong>₱<?php echo number_format($order['total_amount'], 2); ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="action-buttons">
        <button onclick="window.location.href='index.php'" class="continue-shopping">
            Continue Shopping
        </button>
    </div>
</main>

</body>
</html>