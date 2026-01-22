<?php
session_start();
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

    <?php if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>

        <table style="width:100%; border-collapse: collapse; margin-top:20px;">
            <tr style="background:#f1f1f1;">
                <th style="padding:10px; text-align:left;">Product</th>
                <th style="padding:10px;">Price</th>
            </tr>

            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $item):
                $total += $item['price'];
            ?>
            <tr>
                <td style="padding:10px;"><?php echo $item['name']; ?></td>
                <td style="padding:10px;">₱<?php echo $item['price']; ?></td>
            </tr>
            <?php endforeach; ?>

            <tr style="font-weight:bold;">
                <td style="padding:10px;">Total</td>
                <td style="padding:10px;">₱<?php echo $total; ?></td>
            </tr>
        </table>

        <br>
        <button onclick="window.location.href='placeorder.php'" style="
            background-color: orange;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        ">
            Place Order
        </button>

    <?php endif; ?>
</main>

</body>
</html>
