<!-- cart_page.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Include any necessary styles or scripts here -->
</head>
<body>

    <h2>Your Shopping Cart</h2>

    <?php
    // Check if cart data is present in the POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['cart_data'])) {
        // Decode the JSON data from the POST request
        $cartData = json_decode($_POST['cart_data'], true);

        // Display each item in the cart
        echo '<ul>';
        $total = 0;
        foreach ($cartData as $item) {
            echo '<li>' . $item['name'] . ' - RM' . number_format($item['price'], 2) . '</li>';
            $total += $item['price'];
        }
        echo '</ul>';

        // Display the total price
        echo '<p>Total: RM' . number_format($total, 2) . '</p>';
    } else {
        // If cart data is not present, display a message
        echo '<p>Your cart is empty.</p>';
    }
    ?>

</body>
</html>
