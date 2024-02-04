<?php
session_start();

$itemId = isset($_GET['item_id']) ? $_GET['item_id'] : '';

if (!empty($itemId)) {
    // Assuming you have a session variable to store the cart items
    $_SESSION['cart'][] = $itemId;

    // You can add more logic here, such as updating the database or performing other actions
}

// Send a response back to the client
echo "Item added to cart";
?>
