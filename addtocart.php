<?php
session_start();

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Initialize cart if not exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Get product details from POST
    $product_id = intval($_POST['product_id']);
    $product_name = $_POST['product_name'];
    $product_price = floatval($_POST['product_price']);

    // Create cart item
    $cart_item = array(
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price
    );

    // Add to cart
    $_SESSION['cart'][] = $cart_item;

    // Set success message
    $_SESSION['message'] = $product_name . " added to cart!";

    // Redirect back to index
    header('Location: index.php');
    exit();
} else {
    // If accessed directly, redirect to index
    header('Location: index.php');
    exit();
}
?>