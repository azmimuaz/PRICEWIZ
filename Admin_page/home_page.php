<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./home_page.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../top_nav.css">
    <title>PRICEWIZ</title>
</head>

<body>
    <header>
        <section>
            <?php include '../top_nav.html';?>
    </section>

    </header>

    <main>
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

        $categoryName = "";
        if ($category != '') {
            $categoryQuery = "SELECT category_name FROM category WHERE category_ID = '$category'";
            $categoryResult = $conn->query($categoryQuery);
            if ($categoryRow = $categoryResult->fetch_assoc()) {
                $categoryName = $categoryRow['category_name'];
            }
        }

        // Query for the item list
        $itemQuery = "SELECT * FROM item_info WHERE category_ID = '$category'";
        $itemResult = $conn->query($itemQuery);
        ?>

        <div class="welcome_admin">
            <div>
                <div>
                    <img src="\PRICEWIZ\projectimage\logo_pricewiz (1).png" alt="Your Logo" width="120" height="">
                </div>
            </div>

            <div class="welcome_message">
                <p class="welcome_admin_first">
                    WELCOME TO CONTENT MANAGEMENT SYSTEM
                </p>
                <p class="welcome_div_second">
                    Manage the dashboard data and items details
                </p>
            </div>
        </div>

        <div class="dashboard">
            <?php
            // Establish database connection
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "PRICEWIZ";
            $conn = new mysqli($host, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch data from MySQL for the dashboard
            // Fetch data from MySQL for the dashboard
            $sql = "SELECT * FROM cpi_core"; // Modify the query according to your database schema
            $dashboardResult = $conn->query($sql);

            // Check if there are any rows returned
            if ($dashboardResult->num_rows > 0) {
                ?>
                <div>
                    <div class="dashboard_title">
                        <h2>Dashboard Management</h2>
                    </div>
                    <div class="button-container">
                        <div class="addbutton">
                            <button onclick="location.href='add_data.php'">Add Dashboard Data</button>
                        </div>
                    </div>
                    <div class="dashboard-list-container">
                    <div class="dashboard-list">
                    <?php
                    // Loop through the dashboard results
                    while ($row = $dashboardResult->fetch_assoc()) {
                        $year = date('Y', strtotime($row['price_date']));
                        ?>
                        <div class="dashboard-padding">
                            <span style="font-weight:bold;">Year <?php echo $year; ?></span>
                            <span>Overall: RM<?php echo number_format($row['overall'], 1); ?></span>
                            <span>Food & Beverage: RM<?php echo number_format($row['food_beverage'], 1); ?></span>
                            <span>Clothing: RM<?php echo number_format($row['housing_utilities'], 1); ?></span>
                            <span>Household: RM<?php echo number_format($row['clothing_footwear'], 1); ?></span>
                            <span>Furnishing: RM<?php echo number_format($row['furnishings'], 1); ?></span>
                            <span>Health: RM<?php echo number_format($row['health'], 1); ?></span>
                            <form action="update_data_page.php" method="post">
                                <input type="hidden" name="cpi_id" value="<?php echo isset($row['cpi_id']) ? $row['cpi_id'] : ''; ?>">
                                <div class="item-buttons">
                                    <button class="update-btn" type="submit" name="update_dashboard">Update</button>
                                </div>
                            </form>
                            <div class="dashboard-buttons">
                                <button class="delete-btn" onclick="openDeleteData('<?php echo isset($row['cpi_id']) ? $row['cpi_id'] : ''; ?>')">Delete</button>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    
                </div>
                <?php
            } else {
                // Display a message if no data found
                echo "No data found in the database.";
            }
                        ?>


                    </div>
                </div>
            </div>
        </div>

        <div class="item">
            <div>
                <div class="category_title">
                    <h2>Item Management<?php echo ($categoryName != '') ? " - " . $categoryName : ''; ?></h2>
                </div>
                <div class="button-container">
                    <div class="addbutton">
                        <button onclick="location.href='add_item.php'">Add New Item</button>
                    </div>
                    <div class="category-dropdown">
                        <button class="dropbtn">Select Category</button>
                        <div class="category-dropdown-content">
                            <a href="?category=1">Baby Product</a>
                            <a href="?category=2">Beverage</a>
                            <a href="?category=3">Chilled & Frozen</a>
                            <a href="?category=4">Fresh Product</a>
                            <a href="?category=5">Grocery</a>
                            <a href="?category=6">Health & Beauty</a>
                            <a href="?category=7">Household</a>
                            <a href="?category=8">Meat & Poultry</a>
                        </div>
                    </div>
                </div>
                <div class="item-list-container">
                    <div class="item-list">
                        <?php
                        // Loop through the item results
                        while ($row = $itemResult->fetch_assoc()) {
                        ?>
                            <div class="item-padding">
                                <span><img src="<?php echo $row['item_image']; ?>" alt="Item Image" style="max-width: 50px; max-height: 50px;"></span>
                                <span style="font-weight:bold;"><?php echo $row['item_name']; ?></span>
                                <span>Lotu's: RM<?php echo $row['item_price1']; ?></span>
                                <span>Mydin: RM<?php echo $row['item_price2']; ?></span>
                                <span>Pasar Raya CS: RM<?php echo $row['item_price3']; ?></span>
                                <form action="update_item_page.php" method="post">
                                    <input type="hidden" name="item_ID" value="<?php echo $row['item_ID']; ?>">
                                    <div class="item-buttons">
                                        <button class="update-btn" type="submit" name="update_itemn">Update</button>
                                    </div>
                                </form>
                                <div class="item-buttons">
                                    <button class="delete-btn" onclick="openDeleteModal('<?php echo $row['item_ID']; ?>')">Delete</button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <script>
    function openDeleteModal(itemID) {
        // Set the item_ID value in the modal form
        document.getElementById('deleteItemID').value = itemID;
        // Display the delete modal
        document.getElementById('deleteModal').style.display = 'flex';
    }

    function closeDeleteModal() {
        // Hide the delete modal
        document.getElementById('deleteModal').style.display = 'none';
    }

    function openDeleteData(cpi_id) {
        // Set the item_ID value in the modal form
        document.getElementById('deleteDataID').value = cpi_id;
        // Display the delete modal
        document.getElementById('deleteData').style.display = 'flex';
    }

    function closeDeleteData() {
        // Hide the delete modal
        document.getElementById('deleteData').style.display = 'none';
    }

    // Close the modal when clicking outside of it
    window.onclick = function(event) {
        var deleteModal = document.getElementById('deleteModal');
        var deleteData = document.getElementById('deleteData');
        if (event.target == deleteModal) {
            closeDeleteModal();
        }
        if (event.target == deleteData) {
            closeDeleteData();
        }
    }
</script>

    </main>
    <div id="deleteData" class="modal">
        <div class="modal-content">
            <span onclick="closeDeleteData()" class="close" title="Close Data">×</span>
            <form action="delete_data.php" method="post">
                <h1>Delete Data</h1>
                <p>Are you sure you want to delete this data?</p>
                <!-- Hidden input to store the item_ID -->
                <input type="hidden" id="deleteDataID" name="deleteDataID">
                <div class="clearfix">
                    <button type="button" onclick="closeDeleteData()" class="cancelbtn">Cancel</button>
                    <button type="submit" class="deletebtn">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span onclick="closeDeleteModal()" class="close" title="Close Modal">×</span>
            <form action="delete_item.php" method="post">
                <h1>Delete Item</h1>
                <p>Are you sure you want to delete this item?</p>
                <!-- Hidden input to store the item_ID -->
                <input type="hidden" id="deleteItemID" name="deleteItemID">
                <div class="clearfix">
                    <button type="button" onclick="closeDeleteModal()" class="cancelbtn">Cancel</button>
                    <button type="submit" class="deletebtn">Delete</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
