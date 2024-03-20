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
    <link rel="stylesheet" href="../top_nav.css">
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

<header>
    <section>
        <?php include 'top_nav.html';?>
    </section>
</header>

<section class="h-100 h-custom" style="background-color: #f0f8f0;">
  <div class="container py-5 h-120">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 ">View Cart Calculator</h1>
                    
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
    <!-- <div class="col-md-3 col-lg-3 col-xl-3"> -->
        <!-- Adjusted image size -->
        <!-- <img src="<?php echo $item['image']; ?>" class="img-fluid rounded-3" alt="item img" style="height: auto; max-width: 100%;"> -->
    <!-- </div> -->
    <div class="col-md-3 col-lg-3 col-xl-3.5">
        <h6 class="text-muted">
            <?php
            // Assuming $item['category_id'] contains the category ID
            switch ($item['category']) {
                case 1:
                    echo "Baby Product";
                    break;
                case 2:
                    echo "Beverage";
                    break;
                case 3:
                    echo "Chilled & Frozen";
                    break;
                case 4:
                    echo "Fresh Product";
                    break;
                case 5:
                    echo "Grocery";
                    break;
                case 6:
                    echo "Health & Beauty";
                    break;
                case 7:
                    echo "Household";
                    break;
                case 8:
                    echo "Meat & Poultry";
                    break;
                default:
                    echo "Unknown Category";
            }
            ?>
        </h6>
        
        <h6 class="mb-0"><?php echo $item['name']; ?></h6> <!-- Item name below the category -->
    </div>

    <div class="col-md-4 col-lg-2 col-xl-2">
        <!-- Prices in the same row as the item name -->
        <h6 class="text-muted">LOTU'S</h6>
        <h6 class="mb-0">RM <?php echo number_format($item['price1'], 2); ?></h6>
    </div>

    <div class="col-md-3 col-lg-2 col-xl-2">
        <h6 class="text-muted">MYDIN</h6>
        <h6 class="mb-0">RM <?php echo number_format($item['price2'], 2); ?></h6>
    </div>

    <div class="col-md-3 col-lg-2 col-xl-2">
        <h6 class="text-muted">CS</h6>
        <h6 class="mb-0">RM <?php echo number_format($item['price3'], 2); ?></h6>
    </div>

    <div class="col-md-3 col-lg-2 col-xl-2">
    <h6 class="text-muted">Quantity</h6>
        <h6 class="mb-0">X <?php echo ($item['quantity']); ?></h6>
    </div>
    
    

    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
        <a href="#!" class="text-muted" onclick="removeItem(this)">
            <i class="fas fa-times"></i>
        </a>
    </div>

    <!-- <div class="col-md-5 col-lg-1 col-xl-3 d-flex align-items-end">
       
        
        <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
            <i class="fas fa-minus"></i>
        </button>

        <input id="form1" min="1" name="quantity" value="1" type="number" class="form-control form-control-sm text-center" />
        

        <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
            <i class="fas fa-plus"></i>
        </button>
    </div> -->
</div>


    
    <?php
            // Calculate total price
            $total += $item['price1'];
        }
       
    } else {
        // If cart data is not present, display a message
        echo '<p>Your cart is empty.</p>';
    }
    ?>
</div>


<!-- ====================================================================== -->

                  <hr class="my-4">

                  <div class="pt-5">
                    <h6 class="mb-0"><a href="index.php" class="text-body"><i
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
                        <?php
                        // Calculate total price
                        $totalLotus = 0;
                        foreach ($cartData as $item) {
                            $totalLotus += ($item['price1'] * $item['quantity']);
                        }
                        // Display the total price
                        echo '<h5>RM ' . number_format($totalLotus, 2) . '</h5>';
                        ?>
                </div>

                <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase">Mydin</h5>
                        <?php
                        // Calculate total price
                        $totalMydin = 0;
                        
                        foreach ($cartData as $item) {
                            $totalMydin += $item['price2'] * $item['quantity'];
                        }
                        // Display the total price
                        echo '<h5>RM ' . number_format($totalMydin, 2) . '</h5>';
                        ?>
                </div>


                <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase">Pasaraya CS</h5>
                        <?php
                        // Calculate total price
                        $totalCS = 0;
                        foreach ($cartData as $item) {
                            $totalCS += $item['price3'] * $item['quantity'];
                        }
                        // Display the total price
                        echo '<h5>RM ' . number_format($totalCS, 2) . '</h5>';
                        ?>
                </div>

                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-9">
                    <?php
                    // Initialize variables to store the cheapest price and its corresponding logo
                    $cheapestPrice = min($totalLotus, $totalMydin, $totalCS);
                    $cheapestLogo = '';

                    // Determine the corresponding logo based on which price was the minimum
                    if ($cheapestPrice == $totalLotus) {
                        $cheapestLogo = '<img src="projectImage\logo_lotus.png" alt="Lotus" style="height: 25px; width: 100px;">';
                    } elseif ($cheapestPrice == $totalMydin) {
                        $cheapestLogo = '<img src="projectImage\Logo_of_Mydin.png" alt="Mydin" style="height: 25px; width: 100px;">';
                    } elseif ($cheapestPrice == $totalCS) {
                        $cheapestLogo = '<img src="projectImage/PasarRaya-CS-logo.png" alt="Pasar Raya" style="height: 37px; width: 100px;">';
                    }
                    ?>
                    <div class="d-flex flex-column align-items-center mb-9">
                    <div class="text-center">
                        <h5 class="text-uppercase">Best price</h5>
                        <br>
                    </div>
                </div>
                    <?php echo $cheapestLogo; ?>
                </div>
                <?php
                    // Define the URLs for Lotus, Mydin, and Pasar Raya CS
                    $lotusURL = 'https://www.google.com.my/search?q=lotu%27s+supermarket+near+me&sca_esv=a48dbaf87d89a746&sxsrf=ACQVn0-ECD5N9injQTDpujYTqPfYUPfGRg%3A1707061744982&source=hp&ei=8LG_ZcuEOvuqvr0Pv8O0mAs&iflsig=ANes7DEAAAAAZb_AAHqBQNVdEgj38uNQMbnO68jUkmSZ&ved=0ahUKEwjLvKvHhJKEAxV7la8BHb8hDbMQ4dUDCA0&uact=5&oq=lotu%27s+supermarket+near+me&gs_lp=Egdnd3Mtd2l6Ihpsb3R1J3Mgc3VwZXJtYXJrZXQgbmVhciBtZTIHEAAYgAQYDTIGEAAYFhgeMgsQABiABBiKBRiGAzILEAAYgAQYigUYhgMyCxAAGIAEGIoFGIYDMgsQABiABBiKBRiGA0ibPlDlDViUOXABeACQAQCYAdQBoAGNFKoBBjE3LjguMbgBA8gBAPgBAagCCsICBxAjGOoCGCfCAgQQIxgnwgIKECMYgAQYigUYJ8ICCxAuGIMBGLEDGIAEwgILEAAYgAQYsQMYgwHCAg4QLhiABBixAxjHARjRA8ICCBAAGIAEGLEDwgIUEC4YgAQYigUYsQMYgwEYxwEY0QPCAhEQLhiABBixAxiDARjHARjRA8ICDhAuGIAEGIoFGLEDGIMBwgIFEAAYgATCAhEQLhiDARjHARixAxjRAxiABMICCxAAGIAEGIoFGJIDwgIUEC4YgAQYsQMYgwEYkgMYxwEYrwHCAg4QABiABBixAxiDARjJA8ICERAuGIAEGLEDGIMBGMcBGK8BwgIQEC4YxwEYywEY0QMYgAQYCsICFhAuGIAEGAoYsQMYgwEYkgMYxwEYrwHCAhAQABiABBgKGLEDGIMBGMkDwgITEC4YgAQYChixAxiDARjHARivAcICChAAGIAEGAoYsQPCAg0QABiABBgKGLEDGIMBwgIHEAAYgAQYCsICGRAuGIAEGA0YsQMYgwEYsQMYgwEYxwEYrwHCAhMQABiABBgNGLEDGIMBGLEDGIMBwgITEC4YgAQYDRixAxiDARixAxiDAcICBhAAGB4YDcICDRAuGIAEGA0YxwEYrwHCAgIQJg&sclient=gws-wize';
                    $mydinURL = 'https://www.google.com.my/search?q=mydin+supermarket+near+me&sca_esv=a48dbaf87d89a746&sxsrf=ACQVn09RV1AZ_xTfCfAa89AAHTntkNxM5Q%3A1707061913374&ei=mbK_Zc65FqTAjuMPx6-XwAQ&ved=0ahUKEwiO6tKXhZKEAxUkoGMGHcfXBUgQ4dUDCBA&uact=5&oq=mydin+supermarket+near+me&gs_lp=Egxnd3Mtd2l6LXNlcnAiGW15ZGluIHN1cGVybWFya2V0IG5lYXIgbWUyCxAAGIAEGIoFGJECMgsQABiABBiKBRiGAzILEAAYgAQYigUYhgMyCxAAGIAEGIoFGIYDSOMeUPsGWNIZcAF4AZABAJgBxQOgAbMUqgEJMC41LjQuMS4xuAEDyAEA-AEBwgIKEAAYRxjWBBiwA8ICDRAAGEcY1gQYyQMYsAPCAg4QABiABBiKBRiSAxiwA8ICBhAAGAcYHsICChAjGIAEGIoFGCfCAgcQABiABBgN4gMEGAAgQeIDBRIBMSBAiAYBkAYK&sclient=gws-wiz-serp';
                    $csURL = 'https://www.google.com.my/search?q=pasaraya+cs+near+me&sca_esv=a48dbaf87d89a746&sxsrf=ACQVn085g5kDzxcNHji-I8Ln0Gk-gCiPgg%3A1707061967992&ei=z7K_Zc-WPJ334-EPx7aziAQ&ved=0ahUKEwiPutixhZKEAxWd-zgGHUfbDEEQ4dUDCBA&uact=5&oq=pasaraya+cs+near+me&gs_lp=Egxnd3Mtd2l6LXNlcnAiE3Bhc2FyYXlhIGNzIG5lYXIgbWUyBRAAGIAESPI0UOAGWIIvcAF4AZABAJgBpgOgAaUVqgEKMjEuNS4xLjAuMbgBA8gBAPgBAcICChAAGEcY1gQYsAPCAgcQIxiwAhgnwgILEAAYgAQYigUYhgPCAgYQABgHGB7CAgwQLhgHGB4YxwEY0QPCAhEQABiABBiKBRiRAhixAxiDAcICCBAAGAcYHhgKwgIOEAAYgAQYigUYkQIYsQPCAg0QABiABBgNGLEDGLED4gMEGAAgQYgGAZAGCA&sclient=gws-wiz-serp';

                    $lotusOnline ='https://www.lotuss.com.my/en';
                    $csOnline= 'https://www.mycs.com.my/';
                    $mydinOnline = 'https://www.mydin.my/';
                    // Define the button text based on the cheapest price
                    $buttonText = '';
                    $buttontext2 = '';
                    if ($cheapestPrice == $totalLotus) {
                        $buttonText = 'Locate Lotu\'s';
                        $buttonText2 = 'Shop Lotu\'s Online';
                    } elseif ($cheapestPrice == $totalMydin) {
                        $buttonText = 'Locate Mydin';
                        $buttonText2 = 'Shop at Mydin Online';

                    } elseif ($cheapestPrice == $totalCS) {
                        $buttonText = 'Locate Pasar Raya CS';
                        $buttonText2 = 'Shop at CS Online';

                    }
                    ?>

                    <button type="button" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark" onclick="window.open
                    ('<?php echo $cheapestPrice == $totalLotus ? $lotusURL : ($cheapestPrice == $totalMydin ? $mydinURL : $csURL); ?>', '_blank')">
                        <?php echo $buttonText; ?>
                        
                    </button>
                    <button type="button" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark" onclick="window.open
                    ('<?php echo $cheapestPrice == $totalLotus ? $lotusOnline : ($cheapestPrice == $totalMydin ? $mydinOnline : $csOnline); ?>', '_blank')">
                        <?php echo $buttonText2; ?>
                    </button>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
    // Function to initialize the quantity value when the page loads
    window.onload = function () {
        // Find the initial quantity input element
        var initialQuantityInput = document.querySelector('.form-quantity-input');

        // Update the form1 input value with the initial quantity
        document.getElementById('form1').value = initialQuantityInput.value;
    };

    // Add this script to handle quantity updates and item removal
    function updateQuantity(button, step) {
        // Find the input element in the same row
        var input = button.parentNode.querySelector('.form-quantity-input');

        // Update the input value based on the step value
        input.value = parseInt(input.value) + step;

        // Update the form1 input value with the updated quantity
        document.getElementById('form1').value = input.value;

        // You may want to update the cart array here based on the item and quantity
        // ...

        // Update the cart display
        updateCart();
    }
</script>



<!-- Add this script before the closing </body> tag -->
<script>
    // Retrieve cart data from localStorage
    const cartItems = JSON.parse(localStorage.getItem('cart-items')) || [];

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
            li.textContent = `${item.productName} - RM${item.price1.toFixed(2)}`;
            cartItemsList.appendChild(li);
            total += item.price * input.value;
        });

       
        // Update total
        cartTotal.textContent = total.toFixed(2);
        
    }

    // Display cart items on page load
    window.onload = function () {
        displayCartItems();
    };
</script>

    <script>
        
    </script>

    </body>
</html>