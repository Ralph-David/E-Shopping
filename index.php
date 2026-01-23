<?php
session_start();
require_once 'config.php';

// 1. Define the query string
$sql = "SELECT * FROM products ORDER BY name";

// 2. EXECUTE the query - This creates the $result variable you were missing
$result = $conn->query($sql);

// 3. Error check: If the query fails, stop and show why
if (!$result) {
    die("Database Error: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Mart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="header">
        <div class="logo">  
            <img src="ecomimages/E-Mart.png" alt="E-Mart Logo">
        </div>

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search products..." onkeyup="searchProducts()">
            <button onclick="searchProducts()">Search</button>
        </div>

        <div class="cart-button">
            <button onclick="window.location.href='cart.php'">
                Cart 🛒 
                <?php 
                $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                if($cart_count > 0) echo "($cart_count)";
                ?>
            </button>
        </div>
    </header>

    <main class="container">
        <h2>Welcome to E-Mart</h2>
        <p>Your one-stop shop for everyday essentials.</p>

        <?php if(isset($_SESSION['message'])): ?>
            <div class="alert success">
                <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>

        <div class="products-grid" id="productsGrid">
            <?php 
            // Check if we actually got rows back from the database
            if ($result->num_rows > 0): 
                while($product = $result->fetch_assoc()): 
            ?>
                <div class="product-card" data-name="<?php echo strtolower($product['name']); ?>">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                         alt="<?php echo htmlspecialchars($product['name']); ?>" 
                         width="170" height="170">
                    
                    <p class="price">Price: ₱<?php echo number_format($product['price'], 2); ?></p>
                    
                    <form method="POST" action="addtocart.php" class="add-cart-form">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                        <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                        <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                    </form>
                </div>
            <?php 
                endwhile; 
            else: 
            ?>
                <p>No products found in the database table.</p>
            <?php endif; ?>
        </div>
    </main>

    <script src="script.js"></script>
</body>
</html>