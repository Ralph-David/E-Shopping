<?php
session_start();

// Handle remove item
if(isset($_GET['remove'])) {
    $index = intval($_GET['remove']);
    if(isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
        $_SESSION['message'] = "Item removed from cart.";
    }
    header('Location: cart.php');
    exit();
}

// Handle clear cart
if(isset($_GET['clear'])) {
    unset($_SESSION['cart']);
    $_SESSION['message'] = "Cart cleared.";
    header('Location: cart.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Mart | Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Header -->
<header class="header">
    <div class="logo">
        <img src="ecomimages/E-Mart.png" alt="E-Mart Logo">
    </div>

    <div class="cart-button">
        <button onclick="window.location.href='index.php'">⬅ Back to Shop</button>
    </div>
</header>

<main class="container">
    <h2>Your Shopping Cart</h2>

    <!-- Success/Info message -->
    <?php if(isset($_SESSION['message'])): ?>
        <div class="alert info">
            <?php 
            echo $_SESSION['message']; 
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif; ?>

    <?php if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])): ?>
        <div class="empty-cart">
            <p>Your cart is empty.</p>
            <button onclick="window.location.href='index.php'" class="continue-shopping">Continue Shopping</button>
        </div>
    <?php else: ?>

        <div class="cart-actions">
            <button onclick="if(confirm('Clear all items from cart?')) window.location.href='cart.php?clear=1'" class="clear-cart-btn">
                Clear Cart
            </button>
        </div>

        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $index => $item):
                $total += $item['price'];
            ?>
            <tr>
                <td class="product-name"><?php echo htmlspecialchars($item['name']); ?></td>
                <td class="product-price">₱<?php echo number_format($item['price'], 2); ?></td>
                <td>
                    <button onclick="if(confirm('Remove this item?')) window.location.href='cart.php?remove=<?php echo $index; ?>'" 
                            class="remove-btn">Remove</button>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td><strong>Total</strong></td>
                    <td><strong>₱<?php echo number_format($total, 2); ?></strong></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <div class="cart-footer">
            <button onclick="window.location.href='index.php'" class="continue-shopping">
                Continue Shopping
            </button>
            <button onclick="window.location.href='placeorder.php'" class="place-order-btn">
                Place Order
            </button>
        </div>

    <?php endif; ?>
</main>

</body>
</html>