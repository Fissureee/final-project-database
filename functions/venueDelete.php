<?php
include 'connect.php';

if (isset($_GET['VenueID']) && is_numeric($_GET['VenueID'])) {
    $venueID = $_GET['VenueID'];

    $deleteQuery = $conn->prepare("DELETE FROM Bookings WHERE VenueID = ?");
    $deleteQuery->execute([$venueID]);

    // Perform deletion
    $deleteQuery = $conn->prepare("DELETE FROM Venues WHERE VenueID = ?");
    $deleteQuery->execute([$venueID]);

    // Redirect back to index.php after deletion
    header("Location: ../dashboard/dashboard_venues.php");
    exit();
} else {
    // Invalid or missing UserID parameter
    echo "Invalid request.";
}

// Close the connection
$conn = null;
?>