<?php
$fullnameP = $_POST["fullName"];
$usernameP = $_POST["user_name"];
$passwordP = $_POST["user_pwd"];

$host = "localhost";
$user = "root";
$password = "";
$db = "PRICEWIZ";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
} else {
    $queryInsert = "INSERT INTO user (user_name, full_name, user_pwd) VALUES ('$usernameP', '$fullnameP', '$passwordP')";

    if ($conn->query($queryInsert) === TRUE) {
        // Registration successful, redirect to admin_sign_page.php
        header("Location:\PRICEWIZ\Sign Up\admin_signup_page.php?registration=success");
        exit; // Exit here
    } else {
        // Registration failed, redirect back to admin_signup_page.php with error message
        header("Location: ../admin_signup_page.php?registration=error");
        exit; // Exit here
    }
}
// $conn->close(); // This line is unreachable according to the linter, but it's safe to keep it for good practice
?>
