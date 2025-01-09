<?php
include('../../connect/connection.php');  
if (isset($_GET['id'])) {
    $announcement_id = $_GET['id'];

    // Ensure the 'id' is an integer to prevent SQL injection
    $announcement_id = intval($announcement_id);

    // Prepare the DELETE query to remove the announcement from the database
    $sql = "DELETE FROM announcements WHERE id = ?";

    if ($stmt = $connect->prepare($sql)) {
        // Bind the ID to the prepared statement
        $stmt->bind_param("i", $announcement_id);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to the dashboard after successful deletion
            header("Location: ../dashboard.php");
            exit();  // Make sure the script stops here
        } else {
            echo "Error deleting record: " . $connect->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error preparing the query.";
    }
} else {
    echo "No announcement ID specified.";
}

// Close the database connection
$connect->close();
?>
