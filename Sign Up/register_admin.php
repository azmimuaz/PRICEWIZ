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

$fullnameP = $_POST["fullName"];
$usernameP = $_POST["userName"];
$passwordP = $_POST["password"];


?>
<body>
    <h2> INSERTED ITEM DETAILS</h2>


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
        $queryInsert = "INSERT INTO user (full_name, user_name,user_pwd,) VALUES
        ('".$fullnameP."','".$usernameP."','".$passwordP."',)";
    
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
