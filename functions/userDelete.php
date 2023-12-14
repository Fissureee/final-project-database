<?php
include 'connect.php';

if (isset($_GET['UserID']) && is_numeric($_GET['UserID'])) {
    $userID = $_GET['UserID'];

    $deleteQuery = $conn->prepare("DELETE FROM Bookings WHERE UserID = ?");
    $deleteQuery->execute([$userID]);

    // Perform deletion
    $deleteQuery = $conn->prepare("DELETE FROM Users WHERE UserID = ?");
    $deleteQuery->execute([$userID]);

    // Redirect back to index.php after deletion
    header("Location: ../dashboard/dashboard_users.php");
    exit();
} else {
    // Invalid or missing UserID parameter
    echo "Invalid request.";
}

// Close the connection
$conn = null;
?>