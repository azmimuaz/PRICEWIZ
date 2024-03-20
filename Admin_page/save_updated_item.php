<!DOCTYPE html>
<html>
<head>
    <title>Azmi video list</title>
    <style>
        body {
        }

        input {
            background-color: #F9E79F;
        }

        select {
            background-color: #F9E79F;
        }
    </style>
</head>

<?php
$item_ID = $_POST["item_ID"];
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
<h2> UPDATED ITEM DETAILS DATA</h2>
<br>
<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "PRICEWIZ";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
} else {
    $queryUpdate = "UPDATE item_info SET item_name='".$itemNameP."', category_ID='".$categoryP."', item_price1='".$price1P."',
     item_price2='".$price2P."', item_price3='".$price3P."', item_image='".$targetFilePath."' WHERE item_ID='".$item_ID."' ";
    
    if($conn->query($queryUpdate) === TRUE) {
        // Redirect back to homepage.php
        header("Location: /PRICEWIZ/Admin_page/home_page.php");
        exit();
    } else {
        echo"<p style='red;'>Error: Invalid query " .$conn->error. "</p.";
    }
}
$conn->close()
?>

</body>
</html>
