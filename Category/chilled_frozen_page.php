<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PRICEWIZ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <link href="\PRICEWIZ\index.css" rel="stylesheet">
    <link rel="stylesheet" href="../top_nav.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <style>
        main {
            margin-top: 20px;
            background: #f1f2f7;
        }

        
        .panel {
            border: none;
            box-shadow: none;
        }

        .panel-heading {
            border-color: #eff2f7;
            font-size: 16px;
            font-weight: 300;
        }

        .panel-title {
            color: #2A3542;
            font-size: 14px;
            font-weight: 400;
            margin-bottom: 0;
            margin-top: 0;
            font-family: 'Open Sans', sans-serif;
        }

        .prod-cat li a {
            border-bottom: 1px dashed #d9d9d9;
        }

        .prod-cat li a {
            color: #3b3b3b;
        }

        .prod-cat li ul {
            margin-left: 30px;
        }

        .prod-cat li ul li a {
            border-bottom: none;
        }

        .prod-cat li ul li a:hover,
        .prod-cat li ul li a:focus,
        .prod-cat li ul li.active a,
        .prod-cat li a:hover,
        .prod-cat li a:focus,
        .prod-cat li a.active {
            background: none;
            color: #ff7261;
        }

        .pro-lab {
            margin-right: 20px;
            font-weight: normal;
        }

        .pro-sort {
            padding-right: 20px;
            float: left;
        }

        .pro-page-list {
            margin: 5px 0 0 0;
        }

        .product-list .panel-body {
        height: 250px; /* Set a fixed height for the item container */
        overflow: hidden; /* Hide overflow content if it exceeds the fixed height */
    }

        .product-list img {
            width: 100%;
            border-radius: 4px 4px 4px 4px;
            -webkit-border-radius: 4px 4px 0 0;
        }

        .product-list .pro-img-box {
            position: relative;
        }

        .adtocart {
            background: #258f2d;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            color: #fff;
            display: inline-block;
            text-align: center;
            border: 3px solid #fff;
            left: 42%;
            bottom: -25px;
            position: absolute;
        }

        .adtocart i {
            color: #fff;
            font-size: 25px;
            line-height: 42px;
        }

        .pro-title {
            color: #3b3b3b;
            font-weight: bold;
            display: inline-block;
            margin-top: 20px;
            font-size: 16px;
        }

        .product-list .price {
            color: #fc5959;
            font-size: 15px;
        }

        .pro-img-details {
            margin-left: -15px;
        }

        .pro-img-details img {
            width: 100%;
        }

        .pro-d-title {
            font-size: 16px;
            margin-top: 0;
        }

        .product_meta {
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            padding: 10px 0;
            margin: 15px 0;
        }

        .product_meta span {
            display: block;
            margin-bottom: 10px;
        }

        .product_meta a,
        .pro-price {
            color: #fc5959;
        }

        .pro-price,
        .amount-old {
            font-size: 18px;
            padding: 0 10px;
        }

        .amount-old {
            text-decoration: line-through;
        }

        .quantity {
            width: 120px;
        }

        .pro-img-list {
            margin: 10px 0 0 -15px;
            width: 100%;
            display: inline-block;
        }

        .pro-img-list a {
            float: center;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .pro-d-head {
            font-size: 22px;
            font-weight: 300;
        }

        .keyword-search {
            margin-bottom: 20px;
        }
        .screenShotImg {
            margin-top: 10px; /* Adjust spacing between each item */
            display: flex;
            align-items: center; /* Align items vertically */
        }

        .screenShotImg img {
            margin-right: 10px; /* Adjust spacing between image and price */
        }


    </style>
    <!-- Add this script inside the head section of your HTML -->
<script>
    function addToCart(itemId, event) {
        event.preventDefault(); // Prevent the default link behavior

        // Send an AJAX request to add the item to the cart
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert('Item added to cart successfully!');
            }
            else alert('Item added to cart failed!');
        };
        xhr.open("GET", "/PRICEWIZ/add_to_cart.php?item_id=" + itemId, true);
        xhr.send();
    }
</script>


</head>

<body>
<header>
    <section>
        <?php include '../top_nav.html';?>
    </section>

</header>


    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $category = isset($_GET['category']) ? $_GET['category'] : '';
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "PRICEWIZ";

    $conn = new mysqli($host, $user, $password, $db);

    if ($conn->connect_error) {
        die("Connection Error: " . $conn->connect_error);
    }

    $categoryID = 3; // Assuming 5 is the ID for the "grocery" category
    $query = "SELECT * FROM item_info WHERE category_ID = '$categoryID'";
    $result = $conn->query($query);
    ?>
    <main>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <div class="container bootdey">
        <!-- <div class="col-md-3">
            <section class="panel">
                <div class="panel-body keyword-search">
                    <input type="text" placeholder="Keyword Search" class="form-control" />
                </div>
            </section>
        </div> -->
        <div class="col-mb-3">
            <section class="panel">
                <div class="panel-body">
                <div class="col-md-3">
                <h4><b>Category: Chilled & Frozen</b></h4>
   
                </div>
                    <div class="pull-right">
                        
                        <div class='text-right ml-2'>
                            <li class="nav-item dropdown">
      
                                <div class="dropdown" style="width: 300px;">
                                        <button type="button" class="btn btn-info" data-toggle="dropdown" style="background-color: #258f2d">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>    View Cart <span id="totalQuantityBadge"class="badge badge-pill badge-danger">0</span>
                                        </button>
                                        <div class="dropdown-menu" style="width: 300px;">
                                            <div class="row total-header-section">
                                                
                                            </div>
                                            <div id="cart">
                                                <h4>Selected Items</h4>
                                                
                                                <div id="cart-items" style="margin: 10px; padding: 10px; border-bottom: 1px solid #ccc;"></div>
                                                <br>
                                            </div>
                                            
                                            <div class="nav_cart" style="text-align: center;">
                                                <!-- Update the link to prevent default behavior -->
                                                <button onclick="sendCartToServer();" 
                                                        style="padding: 10px 10px;
                                                            background-color: #258f2d;
                                                            color: #fff;
                                                            border: none;
                                                            cursor: pointer;
                                                            border-radius: 5px;">View Cart Calculator</button>
                                            </div>
                                        </div>
                                    </div>
                            </li>
                        </div>
                    </div>
                    
                </div>
            </section>

            <div class="row product-list">
            <?php
$count = 0;
while ($row = $result->fetch_assoc()) {
    // Determine the lowest price among the item prices
    $lowestPrice = min($row['item_price1'], $row['item_price2'], $row['item_price3']);
    ?>
    <div class="col-md-3">
        <section class="panel">
            <div class="pro-img-box text-center">
                <span><img src="<?php echo $row['item_image']; ?>" alt="Item Image" style="width: 230px; height: 200px; align-items-center"></span>
                <a href="#" class="adtocart" onclick="addToCart(
                        '<?php echo $row['item_image']; ?>',
                        '<?php echo $row['item_name']; ?>',
                        <?php echo $row['item_price1']; ?>, 
                        <?php echo $row['item_price2']; ?>, 
                        <?php echo $row['item_price3']; ?>,
                        '<?php echo $row['category_ID']; ?>'
                    )">
                    <i class="fa fa-shopping-cart"></i>
                </a>
            </div>
            <div class="panel-body text-center">
                <h4>
                    <a href="#" class="pro-title" style="font-size: 17px">
                        <span><?php echo $row['item_name']; ?></span>
                    </a>
                </h4>
                <div class="screenShotImg">
                    <img src="\PRICEWIZ\projectImage\logo_lotus.png" alt="Lotus" style="height: 20px; width: 60px" />
                    <p class="price" style="font-size: 16px">
                        <span style="color: <?php echo $row['item_price1'] == $lowestPrice ? 'green' : 'red'; ?>"><b>RM<?php echo $row['item_price1']; ?></b></span>
                    </p>
                </div>
                <div class="screenShotImg">
                    <img data-testid="advertiser-image" src="\PRICEWIZ\projectImage\Logo_of_Mydin.png" alt="Mydin" class="flex-grow-0 flex-shrink-0 AdvertiserImage_image__bArcZ" style="height: 20px; width: 60px" />
                    <p class="price" style="font-size: 16px">
                        <span style="color: <?php echo $row['item_price2'] == $lowestPrice ? 'green' : 'red'; ?>"><b>RM<?php echo $row['item_price2']; ?></b></span>
                    </p>
                </div>
                <div class="screenShotImg">
                    <img data-testid="advertiser-image" src="/PRICEWIZ/projectImage/PasarRaya-CS-logo.png" alt="PasarRaya CS" class="flex-grow-0 flex-shrink-0 AdvertiserImage_image__bArcZ" style="height: 30px; width: 60px" />
                    <p class="price" style="font-size: 16px">
                        <span style="color: <?php echo $row['item_price3'] == $lowestPrice ? 'green' : 'red'; ?>"><b>RM<?php echo $row['item_price3']; ?></b></span>
                    </p>
                </div>
            </div>
        </section>
    </div>
<?php
    $count++;
}
?>

            </div>
            
            </main>


<script>
    var cart = []; // Array to store cart items

    function addToCart(itemImage, itemName, itemPrice1, itemPrice2, itemPrice3, itemCategory) {
        // Check if the item already exists in the cart
        var existingItem = cart.find(function(item) {
            return item.name === itemName;
            return item.image === itemImage;
        });

        if (existingItem) {
            // Update the quantity of the existing item
            existingItem.quantity++;
        } else {
            // Add the item to the cart array
            cart.push({image: itemImage, name: itemName, price1: itemPrice1, price2: itemPrice2, price3: itemPrice3, category: itemCategory, quantity: 1 });
        }

        // Update the cart display
        updateCart();
        window.location.href = "/PRICEWIZ/cart_page.php?cart_data=" + JSON.stringify(cart);
    }

    function updateCart() {
        // Get the cart element
        var cartElement = document.getElementById('cart-items');

        // Clear existing cart items
        cartElement.innerHTML = '';

        // Initialize total for each price
        var totalLotus = 0;
        var totalMydin = 0;
        var totalCS = 0;
        var totalQuantity = 0;

        // Display each item in the cart
        cart.forEach(function (item) {
            // Create list item for the item with quantity
            var listItem = document.createElement('li');
            var quantityText = ' - Quantity: ' + item.quantity;
            listItem.textContent = item.name + quantityText;
            cartElement.appendChild(listItem);

            // Calculate total for each price and total quantity
            totalLotus += item.price1 * item.quantity;
            totalMydin += item.price2 * item.quantity;
            totalCS += item.price3 * item.quantity;
            totalQuantity += item.quantity;
        });

        // Update the total quantity display
        var totalQuantityBadge = document.getElementById('totalQuantityBadge');
        totalQuantityBadge.textContent = totalQuantity;

        // Update the total in the cart for Lotus price
        var totalElementLotus = document.getElementById('totalLotus');
        totalElementLotus.textContent = totalLotus.toFixed(2);

        // Update the total in the cart for Mydin price
        var totalElementMydin = document.getElementById('totalMydin');
        totalElementMydin.textContent = totalMydin.toFixed(2);

        // Update the total in the cart for CS price
        var totalElementCS = document.getElementById('totalCS');
        totalElementCS.textContent = totalCS.toFixed(2);
    }

    function sendCartToServer() {
        // Convert the cart array to a JSON string
        var cartData = JSON.stringify(cart);

        // Create a form element
        var form = document.createElement('form');
        form.method = 'post';
        form.action = '/PRICEWIZ/cart_page.php';

        // Create an input field to store the cart data
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'cart_data';
        input.value = cartData;

        // Append the input field to the form
        form.appendChild(input);

        // Append the form to the document and submit it
        document.body.appendChild(form);
        form.submit();
    }
</script>




</body>

</html>
