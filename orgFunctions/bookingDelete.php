<?php
include 'connect.php';

if (isset($_GET['BookingID']) && is_numeric($_GET['BookingID'])) {
    $bookingID = $_GET['BookingID'];

    // Perform deletion
    $deleteQuery = $conn->prepare("DELETE FROM Bookings WHERE BookingID = ?");
    $deleteQuery->execute([$bookingID]);

    // Redirect back to index.php after deletion
    header("Location: ../organizer/home.php");
    exit();
} else {
    // Invalid or missing UserID parameter
    echo "Invalid request.";
}

// Close the connection
$conn = null;
?>