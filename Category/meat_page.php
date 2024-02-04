<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PRICEWIZ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="\PRICEWIZ\index.css" rel="stylesheet">
    <link rel="stylesheet" href="../top_nav.css">


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
            background: #fc5959;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            color: #fff;
            display: inline-block;
            text-align: center;
            border: 3px solid #fff;
            left: 45%;
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
            font-size: 18px;
            font-weight: 300;
        }

        .keyword-search {
            margin-bottom: 20px;
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

    $categoryID = 8; // Assuming 5 is the ID for the "grocery" category
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
                    <div class="panel-body keyword-search">
                        <input type="text" placeholder="Keyword Search" class="form-control" />
                    </div>
                </div>
                    <div class="pull-right">
                        <ul class="pagination pagination-sm pro-page-list">
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">»</a></li>
                        </ul>
                        <br>
                        <br>
                        <div class="nav_cart">
                            <!-- Update the link to prevent default behavior -->
                            <button onclick="sendCartToServer();" 
                            style="padding: 10px 20px;
                             background-color: #258f2d;
                             color: #fff;
                             border: none;
                             cursor: pointer; border-radius: 5px;">View Cart Calculator</button>
                        </div>
                    </div>
                    
                </div>
            </section>

            <div class="row product-list">
                <?php
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="col-md-3">
                        <section class="panel">
                            <div class="pro-img-box">
                                <span><img src="<?php echo $row['item_image']; ?>" alt="Item Image" style="width: 230px; height: 200px;"></span>
                                <a href="#" class="adtocart" onclick="addToCart('<?php echo $row['item_name']; ?>', <?php echo $row['item_price1']; ?>)">
                                    <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="panel-body text-center">
                                <h4>
                                    <a href="#" class="pro-title">
                                        <span><?php echo $row['item_name']; ?> </span>
                                    </a>
                                </h4>
                                <div class="screenShotImg">
                                    <img src="https://vectorlogo4u.com/wp-content/uploads/2021/08/lotuss-logo-vector-01.png" alt="Lotus" style="height: 70px; width: 150px" />
                                    <p class="price">
                                        <span>RM<?php echo $row['item_price1']; ?></span>
                                    </p>
                                </div>

                                <div class="screenShotImg">
                                    <img data-testid="advertiser-image" src="/PRICEWIZ/projectImage/mydin-logo.png" alt="Mydin" class="flex-grow-0 flex-shrink-0 AdvertiserImage_image__bArcZ" style="height: 70px; width: 140px" />
                                    <p class="price">
                                        <span>RM<?php echo $row['item_price2']; ?></span>
                                    </p>
                                </div>

                                <div class="screenShotImg">
                                    <img data-testid="advertiser-image" src="/PRICEWIZ/projectImage/PasarRaya-CS-logo.png" alt="PasarRaya CS" class="flex-grow-0 flex-shrink-0 AdvertiserImage_image__bArcZ" style="height: 30px; width: 70px" />
                                    <p class="price">
                                        <span>RM<?php echo $row['item_price3']; ?></span>
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
<!-- Shopping Cart -->
<div id="cart">
    <h2>Shopping Cart</h2>
    <ul id="cart-items"></ul>
    <p>Total: RM<span id="total">0.00</span></p>
</div>

<script>
    var cart = []; // Array to store cart items

    function addToCart(itemName, itemPrice) {
        // Add item to the cart array
        cart.push({ name: itemName, price: itemPrice });

        // Update the cart display
        updateCart();
    }

    function updateCart() {
        // Get the cart element
        var cartElement = document.getElementById('cart-items');

        // Clear existing cart items
        cartElement.innerHTML = '';

        // Display each item in the cart
        var total = 0;
        cart.forEach(function (item) {
            var listItem = document.createElement('li');
            listItem.textContent = item.name + ' - RM' + item.price.toFixed(2);
            cartElement.appendChild(listItem);

            // Calculate the total price
            total += item.price;
        });

        // Update the total in the cart
        var totalElement = document.getElementById('total');
        totalElement.textContent = total.toFixed(2);
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
