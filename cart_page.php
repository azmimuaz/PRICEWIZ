<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Font Awesome CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Add your custom styles -->
    <style>
        /* Add your styles here */
        @media (min-width: 1025px) {
            .h-custom {
                height: 100vh !important;
            }
        }

        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration .select-arrow {
            top: 13px;
        }

        .bg-grey {
            background-color: #eae8e8;
        }
        
        .form-quantity-input {
    text-align: center;
    width: 100%;
    border: 1px solid #dde3ec;
    background: #ffffff;
    font-weight: 500;
    font-size: 10px;
    color: #536387;
    outline: none;
    resize: none;
  }

        @media (min-width: 992px) {
            .card-registration-2 .bg-grey {
                border-top-right-radius: 16px;
                border-bottom-right-radius: 16px;
            }
        }

        @media (max-width: 991px) {
            .card-registration-2 .bg-grey {
                border-bottom-left-radius: 16px;
                border-bottom-right-radius: 16px;
            }
        }
    </style>
</head>
<body>

<?php

session_start();

?>
<section class="h-100 h-custom" style="background-color: #d2c9ff;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 text-black">View Cart Calculator</h1>
                    <h6 class="mb-0 text-muted">3 items</h6>
                  </div>
                  <hr class="my-4">

                  
                  <?php


// Function to fetch item details based on item ID
function getItemDetails($itemId) {
  $host = "localhost";
  $user = "root";
  $password = "";
  $db = "PRICEWIZ";

  $conn = new mysqli($host, $user, $password, $db);

  if ($conn->connect_error) {
      die("Connection Error: " . $conn->connect_error);
  }

  $query = "SELECT * FROM item_info WHERE item_ID = '$itemId'";
  $result = $conn->query($query);

  if ($result && $result->num_rows > 0) {
      $itemDetails = $result->fetch_assoc();
      return $itemDetails;
  } else {
      // Handle the case where no item is found with the given ID
      return false;
  }
}


?>
<div class="container">
    <?php
    // Check if cart data is present in the POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['cart_data'])) {
        // Decode the JSON data from the POST request
        $cartData = json_decode($_POST['cart_data'], true);

        // Display each item in the cart
        $total = 0;
        foreach ($cartData as $item) {
    ?>
            <div class="row mb-4 d-flex justify-content-between align-items-center">
                <div class="col-md-2 col-lg-2 col-xl-2">
                    <img src="\PRICEWIZ\projectImage\grocery_item_bihun.png"
                        class="img-fluid rounded-3" alt="item img">
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3">
                    <h6 class="text-muted">Grocery</h6>
                    <h6 class="text-black mb-0"><?php echo $item['name']; ?></h6>
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
                    <h6 class="mb-0">RM <?php echo number_format($item['price'], 2); ?></h6>
                </div>
                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                    <a href="#!" class="text-muted" onclick="removeItem(this)">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
    <?php
        }
        // Display the total price
        echo '<p class="text-end">Total: RM ' . number_format($total, 2) . '</p>';
    } else {
        // If cart data is not present, display a message
        echo '<p>Your cart is empty.</p>';
    }
    ?>
</div>

<script>
    // Add this script to handle quantity updates and item removal
    function updateQuantity(button, step) {
        // Find the input element in the same row
        var input = button.parentNode.querySelector('input[type=number]');
        
        // Update the input value based on the step value
        input.value = parseInt(input.value) + step;
        
        // You may want to update the cart array here based on the item and quantity
        // ...

        // Update the cart display
        updateCart();
    }

    function removeItem(link) {
        // Find the row element containing the item to be removed
        var row = link.closest('.row');

        // Remove the row from the document
        row.parentNode.removeChild(row);

        // You may want to update the cart array here to remove the item
        // ...

        // Update the cart display
        updateCart();
    }
</script>




<!-- ====================================================================== -->

<hr class="my-4">

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
                  <hr class="my-4">

                  <div class="pt-5">
                    <h6 class="mb-0"><a href="index.html" class="text-body"><i
                          class="fas fa-long-arrow-alt-left me-2"></i>  Back to shop</a></h6>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 bg-grey">
                <div class="p-5">
                  <h3 class="fw-bold mb-5 mt-2 pt-1">Total price</h3>
                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase">Lotu's</h5>
                    <h5> RM 35.0</h5>
                  </div>

                  <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase">Mydin</h5>
                    <h5>RM 32.00</h5>
                  </div>

                  <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase">PasaRaya CS</h5>
                    <h5>RM 31.00</h5>
                  </div>

            

                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-5">
                    <h5 class="text-uppercase">Best price</h5>
                    <h5>Pasar Raya CS</h5>
                  </div>

                  <button type="button" class="btn btn-dark btn-block btn-lg"
                    data-mdb-ripple-color="dark">RM31.00</button>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Add this script before the closing </body> tag -->
<script>
    // Retrieve cart data from localStorage
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

    // Function to display cart items
    function displayCartItems() {
        const cartItemsList = document.getElementById('cart-items-list');
        const cartTotal = document.getElementById('cart-total');
        let total = 0;

        // Clear previous items
        cartItemsList.innerHTML = "";

        // Add each item to the cart display
        cartItems.forEach(item => {
            const li = document.createElement('li');
            li.textContent = `${item.productName} - RM${item.price.toFixed(2)}`;
            cartItemsList.appendChild(li);
            total += item.price;
        });

        // Update total
        cartTotal.textContent = total.toFixed(2);
    }

    // Display cart items on page load
    window.onload = function () {
        displayCartItems();
    };
</script>

    </body>
</html>