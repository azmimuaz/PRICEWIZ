<!DOCTYPE html>
<html>
<head>
    <title>PRICEWIZ</title>
    <style>
        body{
            background-image: url("\PRICEWIZ\projectImage\backgroundform.jpg");
            background-size: cover;
            height: 100%;
        }
        input{
            background-color: #F9E79F ;
        }
        select{
            background-color: #F9E79F;
        }
    </style>
</head>
<?php

$itemNameP = $_POST["itemName"];
$categoryP = $_POST["category"];
$price1P = $_POST["price1"];
$price2P = $_POST["price2"];
$price3P = $_POST["price3"];

// Handling file upload
$imageP = $_FILES["itemImage"]["name"];
$targetDir = "../uploads/";  // specify the directory where you want to store uploaded files
$targetFilePath = $targetDir . $imageP;



// Move uploaded file to the specified directory
move_uploaded_file($_FILES["itemImage"]["tmp_name"], $targetFilePath);
?>
<body>
    <h2> INSERTED ITEM DETAILS</h2>
    <br>
    <table>
        <tr>
            <td>Item Name: </td>
            <td><b><?php echo $itemNameP; ?></b></td>
        </tr>
        <tr>
            <td>Item Category: </td>
            <td><b><?php echo $categoryP; ?></b></td>
        </tr>
        <tr>
            <td>Lotu's Price: </td>
            <td><b><?php echo $price1P; ?></b></td>
        </tr>
        <tr>
            <td>Mydin Price: </td>
            <td><b><?php echo $price2P; ?></b></td>
        </tr>
        <tr>
            <td>Pasar Raya CS price: </td>
            <td><b><?php echo $price3P; ?></b></td>
        </tr>
        <tr>
            <td>Item Image: </td>
            <td><img src="<?php echo $targetFilePath; ?>" alt="Item Image" style="max-width: 200px; max-height: 200px;"></td>
        </tr>
    </table>
    <br>

    <?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "PRICEWIZ";

	error_reporting(E_ALL);
	ini_set('display_errors', 1);

    $conn = new mysqli($host, $user, $password, $db);

    if ($conn->connect_error)
    {
        die("Connection Error: " . $conn->connect_error);
    }
    else
    {
        $queryInsert = "INSERT INTO item_info (item_name, category_ID, item_price1, item_price2, item_price3, item_image) VALUES
        ('".$itemNameP."','".$categoryP."','".$price1P."','".$price2P."','".$price3P."','".$targetFilePath."')";
    
        if($conn->query($queryInsert) === TRUE)
        {
            echo "<p style='color:gold;'>Success insert new item record</p>";
        }
        else
        {
            echo "<p style='color:red;'>Error: Invalid query " .$conn->error. "</p.";
        }
    }
    $conn->close();
    ?>
	    <a href="add_item.php"><button    
		style=" font-size: 16px;
		border-radius: 5px;
		padding: 14px 25px;
		border: none;
		font-weight: 500;
		background-color: #6a64f1;
		color: white;
		cursor: pointer;
		margin-top: 25px;">
		Add More Item</button></a>

        <a href="home_page.php"><button    
		style=" font-size: 16px;
		border-radius: 5px;
		padding: 14px 25px;
		border: none;
		font-weight: 500;
		background-color: #6a64f1;
		color: white;
		cursor: pointer;
		margin-top: 25px;">
		Return to Item Management</button></a>
</body>
</html>
