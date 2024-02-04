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

        $query = "SELECT * FROM item_info WHERE category_ID = '$category'";
        $result = $conn->query($query);
        ?>

        <div class="welcome_admin">
            <div>
                <div>
                    <img src="\PRICEWIZ\projectimage\logo_pricewiz (1).png" alt="Your Logo" width="120" height="">
                </div>
            </div>

            <div class="welcome_message">
                <p class="welcome_admin_first">
                    WELCOME ADMIN, Azmi!
                </p>
                <p class="welcome_div_second">
                    Try searching for a specific item and goods, or even category!
                </p>
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
                        while ($row = $result->fetch_assoc()) {
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
                        <?php
                        }
                        ?>
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

            // Close the modal when clicking outside of it
            window.onclick = function(event) {
                var modal = document.getElementById('deleteModal');
                if (event.target == modal) {
                    closeDeleteModal();
                }
            }
        </script>
    </main>
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
