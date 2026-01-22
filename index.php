<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Mart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Header / Logo -->
    <header class="header">
        <div class="logo">  
            <img src="ecomimages/E-Mart.png" alt="E-Mart Logo">
        </div>

        <div class ="search bar">
            <input type="text" id="searchInput" placeholder="Search products...">
            <button onclick="searchProducts()">Search</button>
        </div>

        <div class="cart-button">
            <button onclick="window.location.href='Cart.php'">Cart 🛒</button>
        </div>
    </header>

    

    <!-- Main Content -->
    <main class="container">
        <h2>Welcome to E-Mart</h2>
        <p>Your one-stop shop for everyday essentials.</p>

        <!-- Products Grid -->
        <div class="products-grid">
            <!-- Personal Care -->
            <div class="product-card">
                <h3>Colgate Toothpaste</h3>
                <img src="ecomimages/colgate-toothpaste.jpg" alt="Colgate Toothpaste" width = "170" height = "170">
                <p>Price: ₱95</p>
                <button>Add to Cart</button>
            </div>

            <div class="product-card">
                <h3>Toothbrush</h3>
                <img src="ecomimages/curaprox.png" alt="Toothbrush" width = "170" height = "170">
                <p>Price: ₱40</p>
                <button>Add to Cart</button>
            </div>

            <div class="product-card">
                <h3>Shampoo</h3>
                <img src="ecomimages/Olaplex-shampoo.jpg" alt="Shampoo" width = "170" height = "170">
                <p>Price: ₱150</p>
                <button>Add to Cart</button>
            </div>

            <div class="product-card">
                <h3> Liquid Hand Soap</h3>
                <img src="ecomimages/handsoap.png" alt="Soap" width = "170" height = "170">
                <p>Price: ₱40</p>
                <button>Add to Cart</button>
            </div>

            <div class="product-card">
                <h3>Toilet Paper</h3>
                <img src="ecomimages/toilet-paper.jpg" alt="Toilet Paper" width = "170" height = "170">
                <p>Price: ₱110</p>
                <button>Add to Cart</button>
            </div>

            <!-- Cleaning Supplies -->
            <div class="product-card">
                <h3>Domex</h3>
                <img src="ecomimages/Domex.jpg" alt="Domex" width = "170" height = "170">
                <p>Price: ₱120</p>
                <button>Add to Cart</button>
            </div>

            <div class="product-card">
                <h3>Liquid Soap Face & Body Wash</h3>
                <img src="ecomimages/safeguard-liquidsoap.jpg" alt="Liquid Hand Soap" width = "170" height = "170">
                <p>Price: ₱85</p>
                <button>Add to Cart</button>
            </div>

            <div class="product-card">
                <h3>Window Cleaner</h3>
                <img src="ecomimages/Windex.jpg" alt="Window Cleaner" width = "170" height = "170">
                <p>Price: ₱100</p>
                <button>Add to Cart</button>
            </div>

            <div class="product-card">
                <h3>Scents / Albatroz</h3>
                <img src="ecomimages/Albatross(1).png" alt="Scents / Albatroz" width = "170" height = "170">
                <p>Price: ₱90</p>
                <button>Add to Cart</button>
            </div>

            <div class="product-card">
                <h3>Bar Detergent</h3>
                <img src="ecomimages/Surfbar.jpg" alt="Bar Detergent" width = "170" height = "170">
                <p>Price: ₱60</p>
                <button>Add to Cart</button>
            </div>
        </div>
    </main>

</body>
</html>
