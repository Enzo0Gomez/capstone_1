<?php
include('../../connect/connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['announcementTitle'];
    $description = $_POST['announcementDescription'];
    $date_time = $_POST['announcementDateTime'];

    $stmt = $connect->prepare("INSERT INTO announcements (title, description, date_time) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $date_time);

    if ($stmt->execute()) {
        echo "Announcement saved successfully!";
        header("Location: ../dashboard.php"); // Redirect to the dashboard after saving
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>