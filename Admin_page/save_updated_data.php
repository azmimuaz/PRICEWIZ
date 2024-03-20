<!DOCTYPE html>
<html>
<head>
<title>Azmi video list</title>
<style>
	body{
	
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
$cpi_id = $_POST["cpi_id"];
$year = $_POST["price_date"];
$overallPrices = $_POST["overall"];
$foodBeveragePrices = $_POST["food_beverage"];
$householdEquipmentPrices = $_POST["housing_utilities"];
$clothingFootwearPrices = $_POST["clothing_footwear"];
$furnishingPrices  =$_POST["furnishings"];
$healthPrices = $_POST["health"];
?>

<body>
<h2> UPDATED ITEM DETAILS DATA</h2>
<br>
<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "PRICEWIZ";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error)
{
	die("Connection Error: " . $conn->connect_error);
}
else
{
	$queryUpdate = "UPDATE cpi_core SET price_date='".$year."', overall='".$overallPrices."', food_beverage='".$foodBeveragePrices."',
    housing_utilities='".$householdEquipmentPrices."', clothing_footwear='".$clothingFootwearPrices."', furnishings='".$furnishingPrices."',
    health='".$healthPrices."'WHERE cpi_id='".$cpi_id."' ";
	
	if($conn->query($queryUpdate) === TRUE) {
        // Redirect back to homepage.php
        header("Location: /PRICEWIZ/Admin_page/home_page.php");
        exit();
    } 
	else
	{
		echo"<p style='red;'>Error: Invalid query " .$conn->error. "</p.";
	}
	
}
$conn->close()
?>

</body>
</html>
<?php 

?>