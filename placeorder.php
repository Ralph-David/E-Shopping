<?php
session_start();
require_once 'config.php';

// Redirect if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $customer_email = $conn->real_escape_string($_POST['customer_email']);
    $customer_phone = $conn->real_escape_string($_POST['customer_phone']);
    $customer_address = $conn->real_escape_string($_POST['customer_address']);
    
    // Calculate total
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'];
    }
    
    // Insert order into database
    $sql = "INSERT INTO orders (customer_name, customer_email, customer_phone, customer_address, total_amount) 
            VALUES ('$customer_name', '$customer_email', '$customer_phone', '$customer_address', $total)";
    
    if ($conn->query($sql)) {
        $order_id = $conn->insert_id;
        
        // Insert order items
        foreach ($_SESSION['cart'] as $item) {
            $product_id = intval($item['id']);
            $product_name = $conn->real_escape_string($item['name']);
            $price = floatval($item['price']);
            
            $sql_item = "INSERT INTO order_items (order_id, product_id, product_name, price, quantity) 
                        VALUES ($order_id, $product_id, '$product_name', $price, 1)";
            $conn->query($sql_item);
        }
        
        // Clear cart
        unset($_SESSION['cart']);
        
        // Redirect to success page
        header("Location: order_success.php?order_id=$order_id");
        exit();
    } else {
        $error = "Error placing order. Please try again.";
    }
}

// Calculate total for display
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Mart | Place Order</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <div class="logo">
        <img src="ecomimages/E-Mart.png" alt="E-Mart Logo">
    </div>
    <div class="cart-button">
        <button onclick="window.location.href='cart.php'">⬅ Back to Cart</button>
    </div>
</header>

<main class="container">
    <h2>Place Your Order</h2>

    <?php if(isset($error)): ?>
        <div class="alert error"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="order-container">
        <!-- Order Summary -->
        <div class="order-summary">
            <h3>Order Summary</h3>
            <table class="summary-table">
                <?php foreach ($_SESSION['cart'] as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td>₱<?php echo number_format($item['price'], 2); ?></td>
                </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td><strong>Total:</strong></td>
                    <td><strong>₱<?php echo number_format($total, 2); ?></strong></td>
                </tr>
            </table>
        </div>

        <!-- Customer Information Form -->
        <div class="order-form">
            <h3>Customer Information</h3>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="customer_name">Full Name *</label>
                    <input type="text" id="customer_name" name="customer_name" required>
                </div>

                <div class="form-group">
                    <label for="customer_email">Email Address *</label>
                    <input type="email" id="customer_email" name="customer_email" required>
                </div>

                <div class="form-group">
                    <label for="customer_phone">Phone Number *</label>
                    <input type="tel" id="customer_phone" name="customer_phone" required>
                </div>

                <div class="form-group">
                    <label for="customer_address">Delivery Address *</label>
                    <textarea id="customer_address" name="customer_address" rows="4" required></textarea>
                </div>

                <button type="submit" class="submit-order-btn">Confirm Order</button>
            </form>
        </div>
    </div>
</main>

</body>
</html>