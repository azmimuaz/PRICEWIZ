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

$year = $_POST["price_date"];
$overallPrices = $_POST["overall"];
$foodBeveragePrices = $_POST["food_beverage"];
$householdEquipmentPrices = $_POST["housing_utilities"];
$clothingFootwearPrices = $_POST["clothing_footwear"];
$furnishingPrices  =$_POST["furnishings"];
$healthPrices = $_POST["health"];





?>
<body>
    <h2> INSERTED ITEM DETAILS</h2>
    <br>
    <table>
        <tr>
            <td>Data date: </td>
            <td><b><?php echo $year; ?></b></td>
        </tr>
        <tr>
            <td>Overall Price: </td>
            <td><b><?php echo $overallPrices; ?></b></td>
        </tr>
        <tr>
            <td>Food & Beverage Price: </td>
            <td><b><?php echo $foodBeveragePrices; ?></b></td>
        </tr>
        <tr>
            <td>Clothing Price: </td>
            <td><b><?php echo $householdEquipmentPrices; ?></b></td>
        </tr>
        <tr>
            <td>Household Price: </td>
            <td><b><?php echo $clothingFootwearPrices; ?></b></td>
        </tr>
        <tr>
            <td>Furnishing Price: </td>
            <td><b><?php echo $furnishingPrices; ?></b></td>
        </tr>
        <tr>
            <td>Health Price: </td>
            <td><b><?php echo $healthPrices; ?></b></td>
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
        $queryInsert = "INSERT INTO cpi_core (price_date, overall, food_beverage, housing_utilities, clothing_footwear, furnishings, health) VALUES
        ('".$year."','".$overallPrices."','".$foodBeveragePrices."','".$householdEquipmentPrices."','".$clothingFootwearPrices."','".$furnishingPrices."','".$healthPrices."')";
    
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
		Add More Data</button></a>

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
