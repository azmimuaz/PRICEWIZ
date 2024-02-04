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
            echo '<h6 class="text-black mb-0">' . $item['name'] . ' - RM' . number_format($item['price'], 2) . '</h6>';
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
<div class="row mb-4 d-flex justify-content-between align-items-center">
  <div class="col-md-2 col-lg-2 col-xl-2">
      <img src="\PRICEWIZ\projectImage\grocery_item_bihun.png"
          class="img-fluid rounded-3" alt="item img">
  </div>
  <div class="col-md-3 col-lg-3 col-xl-3">
      <h6 class="text-muted">Grocery</h6>
      <h6 class="text-black mb-0">CAP BINTANG Bihun</h6>
  </div>
  <div class="col-md-3 col-lg-3 col-xl-2 d-flex align-items-center"> <!-- Updated class here -->
      <button class="btn btn-link px-2"
              onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
          <i class="fas fa-minus"></i>
      </button>

      <input id="form1" min="0" name="quantity" value="1" type="number"
          class="form-control form-control-sm text-center" /> <!-- Updated class here -->

      <button class="btn btn-link px-2"
              onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
          <i class="fas fa-plus"></i>
      </button>
  </div>
  <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
      <h6 class="mb-0">RM 4.30</h6>
  </div>
  <div class="col-md-1 col-lg-1 col-xl-1 text-end">
      <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
  </div>
</div>

otice: Undefined index: quantity in C:\wamp64\www\PRICEWIZ\cart_page.php on line