<!-- delete funtion dah okay kena buat auto refresh je  -->
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the item_ID from the form
    $dataIDToDelete = $_POST['deleteDataID'];

    // Your database connection details
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "PRICEWIZ";

    // Create a new MySQLi instance
    $conn = new mysqli($host, $user, $password, $db);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection Error: " . $conn->connect_error);
    }

    // Prepare and execute the DELETE query
    $deleteDataQuery = "DELETE FROM cpi_core WHERE cpi_id = ?";
    $stmt = $conn->prepare($deleteDataQuery);

    // Bind the parameter
    $stmt->bind_param("i", $dataIDToDelete);

    if ($stmt->execute()) {
        // Item deleted successfully
        header("Location: /PRICEWIZ/Admin_page/home_page.php");
        exit();
    } else {
        // Error in deletion
        echo "Error deleting item: " . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} 
else {
    // If the form is not submitted through POST method, redirect to the home page or any other appropriate page
    header("Location: /PRICEWIZ/Admin_page/home_page.php");
    exit();
}
?>
